<?php

namespace app\modules\user\forms\frontend;

use app\modules\user\Module;
use app\modules\user\models\User;
use yii\base\InvalidArgumentException;

class EmailConfirm // Подтверждение электронной почты
{
    private $_user; // Переменная для хранения пользователя

    /**
    * @param  string $token
    * @param  array $config
    * @throws \yii\base\InvalidArgumentException
    */
    public function __construct($token, $config = []) // Создать модель формы по токену.
    {
        if (empty($token) || !is_string($token)) { // Если переменная (пуста || не евляется сторокой)
            throw new InvalidArgumentException(Module::t('module', 'ERROR_MISSING_CONFIRMATION_CODE')); // Сообщение об ошибке
        }
        $this->_user = User::findByEmailConfirmToken($token); // Получение почты по токену
        if (!$this->_user) { // Если переменная не существует
            throw new InvalidArgumentException(Module::t('module', 'ERROR_INVALID_TOKEN')); // Сообщение об ошибке
        }
        //parent::__construct($config);
    }

    /**
    * @return boolean
    */
    public function confirmEmail() // Подтвердить Email
    {
        $user = $this->_user;
        $user->status = User::STATUS_ACTIVE; // Активировать пользователя
        $user->removeEmailConfirmToken();    // Удалить токен

        return $user->save(); // Сохранить пользователя
    }
}