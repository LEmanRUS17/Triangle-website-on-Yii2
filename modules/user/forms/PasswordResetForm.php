<?php

namespace app\modules\user\forms;

use yii\base\InvalidArgumentException;
use app\modules\user\Module;
use yii\base\Model;
use app\modules\user\models\User;

/**
 * Форма сброса пароля
 */
class PasswordResetForm extends Model
{
    public $password; // Пароль

    /**
     * @var \common\models\User
     */
    private $_user;

    /**
     * Создает модель формы по токену .
     *
     * @param string $token
     * @param integer $timeout
     * @param array $config Пары имя-значение, которые будут использоваться для инициализации свойств объекта
     * @throws \yii\base\InvalidArgumentException Если токен пуст или недействителен
     */
    public function __construct($token, $timeout, $config = [])
    {
        if (empty($token) || !is_string($token)) { // Если (токен получен || толкен не строка)
            throw new InvalidArgumentException(Module::t('module', 'ERROR_RASSWORD_RESET_TOKEN_EMPTY')); // Вывод сообщения
        }
        $this->_user = User::findByPasswordResetToken($token, $timeout); // Найти пользователя по токены сброса пароля
        if (!$this->_user) { // Если пользователь найден
            throw new InvalidArgumentException(Module::t('module', 'ERROR_RASSWORD_RESET_TOKEN_EMPTY')); // Вывод сообщения
        }
        parent::__construct($config); // Доступ к радительскому методу
    }

    /**
     * @inheritdoc
     */
    public function rules() // Правила валидации
    {
        return [
            ['password', 'required'],           // Пароль | Обязательный
            ['password', 'string', 'min' => 6], // Пароль | Строка, от 6 символов
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() // Значение атрибутов
    {
        return [
            'password' => Module::t('module', 'USER_NEW_PASSWORD'),
        ];
    }

    /**
     * Сбросить пароль.
     *
     * @return bool если пароль был сброшен
     */
    public function resetPassword() // Сбросить пароль
    {
        $user = $this->_user;
        $user->setPassword($this->password); // Генерация хэш пароля
        $user->removePasswordResetToken();   // Удаление токена
        $user->generateAuthKey();            // Генерация дополнительного ключа

        return $user->save(false); // Сохранить пользователя
    }
}