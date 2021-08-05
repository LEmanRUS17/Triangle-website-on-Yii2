<?php

namespace app\modules\user\models;

use yii\base\Model;
use Yii;

class SignUpForm extends Model
{
    public $username;   // Имя пользователя
    public $email;      // Email
    public $password;   // Пароль
    public $verifyCode; // Код Проверки

    public function rules() // Правиля валидации
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],                                                                       // Имя пользователя | Фильтр
            ['username', 'required'],                                                                                         // Имя пользователя | Обазательно
            ['username', 'match', 'pattern' => '#^[\w_-]+$#i'],                                                               // Имя пользователя |
            ['username', 'unique', 'targetClass' => User::className(), 'message' => 'This username has already been taken.'], // Имя пользователя |
            ['username', 'string', 'min' => 2, 'max' => 255],                                                                 // Имя пользователя | Строка, минимальная длина 2, максимальная 255

            ['email', 'filter', 'filter' => 'trim'],                                                                            // Email | Фильтр
            ['email', 'required'],                                                                                              // Email | Обязательно
            ['email', 'email'],                                                                                                 // Email | Тип: email
            ['email', 'unique', 'targetClass' => User::className(), 'message' => 'This email address has already been taken.'], // Email |

            ['password', 'required'],           // Пароль | Обязательн
            ['password', 'string', 'min' => 6], // Пароль | Строка, минимальная длина 6

            ['verifyCode', 'captcha', 'captchaAction' => '/user/default/captcha'], // Код проверки |
        ];
    }

    public function attributeLabels() // Значение атрибутов
    {
        return [
            'username'   => 'Логин',
            'password'   => 'Пароль',
            'email'      => 'E-mails',
            'verifyCode' => 'Введите текст с картинки'
        ];
    }

    public function signUp() // Регистрация
    {
        if ($this->validate()) { // Если прошла валидация
            $user = new User();                  // Новый обект модели User
            $user->username = $this->username;   // Записать имя пользователя
            $user->email = $this->email;         // Записать email
            $user->setPassword($this->password); // Записать пароль
            $user->status = User::STATUS_WAIT;   // Записать статус
            $user->generateAuthKey();            // Записать дополнительного ключа
            $user->generateEmailConfirmToken();  // Записать токен подтверждения электронной почты

            // Выполнить проверку регестрации:
            if ($user->save()) { // Если пользователь сохранен
                Yii::$app->mailer->compose('@app/modules/user/mails/emailConfirm', ['user' => $user])
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                    ->setTo($this->email)
                    ->setSubject('Email confirmation for ' . Yii::$app->name)
                    ->send();
                return $user;
            }
        }

        return null;
    }
}