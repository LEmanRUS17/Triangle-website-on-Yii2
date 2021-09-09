<?php

namespace app\modules\user\forms;

use app\modules\user\Module;
use app\modules\user\models\User;
use yii\base\Model;
use Yii;

/**
 * Форма запроса сброса пароля
 */
class PasswordResetRequestForm extends Model
{
    public $email;

    private $_user = false;
    private $_timeout;

    /**
     * Конструктор формы запроса сброса пароля.
     * @param integer $timeout
     * @param array $config
     */
    public function __construct($timeout, $config = [])
    {
        $this->_timeout = $timeout;
        parent::__construct($config); // Доступ к радительскому методу
    }

    /**
     * @inheritdoc
     */
    public function rules() // Правила валидации
    {
        return [
            ['email', 'filter', 'filter' => 'trim'], // Email | Удалить лишние пробелы
            ['email', 'required'],                   // Email | Обязательный
            ['email', 'email'],                      // Email | Тип: email
            ['email', 'exist',                       // Email |
                'targetClass' => User::class,
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => Module::t('module', 'ERROR_USER_NOT_FOUND_BY_EMAIL')
            ],
            ['email', 'validateIsSent'],             // Email | "Отправление подтвеждено"
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() // Значение атрибутов
    {
        return [
            'email' => Module::t('module', 'USER_EMAIL'),
        ];
    }

    /**
     * @param string $attribute
     * @param array $params
     */
    public function validateIsSent($attribute, $params) // Подтверждение отправления
    {
        if (!$this->hasErrors() && $user = $this->getUser()) { // Если: ошибок не найдено && пользователь получен
            if (User::isPasswordResetTokenValid($user->$attribute, $this->_timeout)) { // Если токен сброса пароля действителен
                $this->addError($attribute, Module::t('module', 'ERROR_TOKEN_IS_SENT'));
            }
        }
    }

    /**
     * Отправляет электронное письмо со ссылкой для сброса пароля.
     *
     * @return boolean было ли электронное письмо отправлено
     */
    public function sendEmail() // Отправка письма для сброса пароля
    {
        if ($user = $this->getUser()) { // Если пользователь получен
            $user->generatePasswordResetToken(); // Генерация токена для востановления пароля
            if ($user->save()) { // Если: пользователь сохранен
                // Отправка сообщения:
                return Yii::$app->mailer->compose('@app/modules/user/mails/passwordReset', ['user' => $user])
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                    ->setTo($this->email)
                    ->setSubject('Password reset for ' . Yii::$app->name)
                    ->send();
            }
        }
        return false;
    }

    /**
     * Находит пользователя по [[username]]
     *
     * @return User|null
     */
    public function getUser() // Найти пользователя
    {
        if ($this->_user === false) { // Если переменная пользователя пуста
            $this->_user = User::findOne([ // Найти пользователя с параметрами
                'email' => $this->email,         // email соответствует
                'status' => User::STATUS_ACTIVE, // Пользователь активирован
            ]);
        }

        return $this->_user;
    }
}