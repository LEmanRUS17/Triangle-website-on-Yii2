<?php

namespace app\modules\user\forms;

use app\modules\user\models\User;
use app\modules\user\Module;
use Yii;
use yii\base\Model;

/**
 * Форма входа в акаунт
 *
 * @property-read User|null $user Это свойство доступно только для чтения.
 *
 */
class LoginForm extends Model
{
    public $username;           // Имя пользователя
    public $password;           // Пароль
    public $rememberMe = false; // Запомнить пользователя

    private $_user = false;

    /**
     * @return array
     */
    public function rules() // Правила валидации
    {
        return [
            [['username', 'password'], 'required'], // Имя пользователя, пароль | Обязателно
            ['rememberMe', 'boolean'],              // Запомнить пользователя   | Тип: boolean
            ['password', 'validatePassword'],       // Пароль                   | Валидация методом 'validatePassword'
        ];
    }

    public function attributeLabels() // Значение атрибутов
    {
        return [
            'username'   => Module::t('module', 'LOGIN_USERNAME'),
            'password'   => Module::t('module', 'LOGIN_PASSWORD'),
            'rememberMe' => Module::t('module', 'LOGIN_REMEMBER_ME'),
        ];
    }

    public function validatePassword() // Валидация пароля
    {
        if (!$this->hasErrors()) { // Если ошибок не вазникло
            $user = $this->getUser(); // Получить пользователя

            if (!$user || !$user->validatePassword($this->password)) { // Если пользователь (не существует || пароль не прошол валидацию
                $this->addError('password', Module::t('module', 'MESSAGE_LOGIN_PASSWORD')); // Вывести сообщение
            } elseif ($user && $user->status == User::STATUS_BLOCKED) { // Если пользоветель (существует && пользователь заблокирован)
                $this->addError('username', Module::t('module', 'MESSAGE_LOGIN_USERNAME_BLOCKED')); // Вывести сообщение
            } elseif ($user && $user->status == User::STATUS_WAIT) { // Если пользоветель (существует && пользователь не подтвержден)
                $this->addError('username', Module::t('module', 'MESSAGE_LOGIN_USERNAME_WAIT')); // Вывести сообщение
            }
        }
    }

    /**
     * @return bool
     */
    public function login() // Выполняет вход пользователя
    {
        if ($this->validate()) { // Если валидация прошла успешно
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * @return User|null
     */
    public function getUser() // Получить пользователя
    {
        if ($this->_user === false) { // Если переменная _user пустая
            $this->_user = User::findByUsername($this->username); // Получить пользователя по username
        }

        return $this->_user;
    }
}
