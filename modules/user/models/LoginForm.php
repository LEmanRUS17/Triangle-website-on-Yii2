<?php

namespace app\modules\user\models;

use app\modules\user\models\User;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user This property is read-only.
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
            'username'   => Yii::t('app', 'LOGIN_USERNAME'),
            'password'   => Yii::t('app', 'LOGIN_PASSWORD'),
            'rememberMe' => Yii::t('app', 'LOGIN_REMEMBER_ME'),
        ];
    }

    public function validatePassword() // Валидация пароля
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError('password', Yii::t('app', 'MESSAGE_LOGIN_PASSWORD'));
            } elseif ($user && $user->status == User::STATUS_BLOCKED) {
                $this->addError('username', Yii::t('app', 'MESSAGE_LOGIN_USERNAME_BLOCKED'));
            } elseif ($user && $user->status == User::STATUS_WAIT) {
                $this->addError('username', Yii::t('app', 'MESSAGE_LOGIN_USERNAME_WAIT'));
            }
        }
    }

    /**
     * @return bool
     */
    public function login() // Выполняет вход пользователя
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * @return User|null
     */
    public function getUser() // Получить пользователя
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
