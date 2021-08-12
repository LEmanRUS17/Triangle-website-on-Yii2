<?php

namespace app\modules\user\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property string $username
 * @property string|null $auth_key
 * @property string|null $email_confirm_token
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 */
class User extends ActiveRecord implements IdentityInterface
{
    // Константы для указания статуса:
    const STATUS_BLOCKED = 0;
    const STATUS_ACTIVE  = 1;
    const STATUS_WAIT    = 2;

    public static function tableName() // Указание названия таблицы к которорой привязана модель
    {
        return 'user';
    }

    //!
    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => ['username', 'email', 'status'],
        ];
    }
    //!

    public function rules() // Правила валидации
    {
        return [
            ['username', 'required'],                                                                                                  // Имя пользователя | Обязательно
            ['username', 'match', 'pattern' => '#^[\w_-]+$#is'],                                                                       // Имя пользователя |
            ['username', 'unique', 'targetClass' => self::class, 'message' => Yii::t('app', 'MESSAGE_USER_USERNAME')], // Имя пользователя | Проверка на уникальность
            ['username', 'string', 'min' => 2, 'max' => 255],                                                                          // Имя пользователя | Строка, минимальный размер 2, максимальный размер 255

            ['email', 'required'],                                                                                               // Email | Обязателен
            ['email', 'email'],                                                                                                  // Email | Тип поля: email
            ['email', 'unique', 'targetClass' => self::class, 'message' => Yii::t('app', 'MESSAGE_USER_EMAIL')], // Email | Проверка на уникальность
            ['email', 'string', 'max' => 255],                                                                                   // Email | Строка, максимальный размер 255

            ['status', 'integer'],                                             // Статус | Целое число
            ['status', 'default', 'value' => self::STATUS_ACTIVE],             // Статус | Значение по умолчанию: STATUS_ACTIVE
            ['status', 'in', 'range' => array_keys(self::getStatusesArray())], // Статус |
        ];
    }

    public function attributeLabels() // Значение атрибутов
    {
        return [
            'id'         => Yii::t('app', 'ATTRIBUTE_USER_ID'),
            'created_at' => Yii::t('app', 'ATTRIBUTE_USER_CREATED_AT'),
            'updated_at' => Yii::t('app', 'ATTRIBUTE_USER_UD_DATED_AT'),
            'username'   => Yii::t('app', 'ATTRIBUTE_USER_USERNAME'),
            'email'      => Yii::t('app', 'ATTRIBUTE_USER_EMAIL'),
            'status'     => Yii::t('app', 'ATTRIBUTE_USER_STATUS'),
        ];
    }

    public function getStatusName() // Получить статус пользователя
    {
        return ArrayHelper::getValue(self::getStatusesArray(), $this->status);
    }

    public static function getStatusesArray() // Получить список статусов
    {
        return [
            self::STATUS_BLOCKED => Yii::t('app', 'STATUS_BLOCKED'),
            self::STATUS_ACTIVE  => Yii::t('app', 'STATUS_ACTIVE'),
            self::STATUS_WAIT    => Yii::t('app', 'STATUS_WAIT'),
        ];
    }

    public function behaviors() // Обновление даты
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public static function findIdentity($id) // Получить пользователя по id
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null) // Найти идентификацию по токену доступа
    {
        throw new NotSupportedException('findIdentityByAccessToken is not implemented.');
    }

    // --- Реализация IdentityInterface --- //
    public function getId() // Получить id
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey() // Получить ключ аутентификации
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey) // Проверка ключа аутентификации
    {
        return $this->getAuthKey() === $authKey;
    }

    public static function findByUsername($username) // Найти пользователя по имени
    {
        return static::findOne(['username' => $username]);
    }

    public function validatePassword($password) // Подтверждение пароля
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
    // -------------------------------------//

    // --- Генерация хеша и ключа автоматической аутентефикации --- //
    public function setPassword($password) // Генерация хэш пароля
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey() // Генерация дополнительного ключа
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function beforeSave($insert) // Запись дополнительного ключа при создпнии записи
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->generateAuthKey();
            }
            return true;
        }
        return false;
    }
    //--------------------------------------------------------------//

    // --- Смена пароля --- //
    public static function findByPasswordResetToken($token) // Найти по токену сброса пароля
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    public static function isPasswordResetTokenValid($token) // Действителен ли токен сброса пароля
    {
        if (empty($token)) { // Если токен существует
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    public function generatePasswordResetToken() // Генерация токена для востановления пароля
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken() // Удаление токена
    {
        $this->password_reset_token = null;
    }
    //--------------------//

    // --- Подтверждение адреса электронной почты --- //
    public static function findByEmailConfirmToken($email_confirm_token) // Найти по электронной почте подтвердить токен
    {
        return static::findOne(['email_confirm_token' => $email_confirm_token, 'status' => self::STATUS_WAIT]);
    }

    public function generateEmailConfirmToken() // Создать токен подтверждения электронной почты
    {
        $this->email_confirm_token = Yii::$app->security->generateRandomString();
    }

    public function removeEmailConfirmToken() // Удалить токен подтверждения электронной почты
    {
        $this->email_confirm_token = null;
    }
    // -----------------------------------------------//
}

