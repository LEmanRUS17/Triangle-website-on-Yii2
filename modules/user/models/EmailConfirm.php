<?php

namespace app\modules\user\models;

use yii\base\InvalidArgumentException;
use Yii;

class EmailConfirm
{
    private $_user;

    /**
    * @param  string $token
    * @param  array $config
    * @throws \yii\base\InvalidArgumentException
    */
    public function __construct($token, $config = []) // Создать модель формы по токену.
    {
        if (empty($token) || !is_string($token)) {
        throw new InvalidArgumentException('Отсутствует код подтверждения.');
        }
        $this->_user = User::findByEmailConfirmToken($token);
        if (!$this->_user) {
        throw new InvalidArgumentException('Неверный токен.');
        }
        parent::__construct($config);
    }

    /**
    * @return boolean
    */
    public function confirmEmail() // Подтвердить Email
    {
        $user = $this->_user;
        $user->status = User::STATUS_ACTIVE;
        $user->removeEmailConfirmToken();

        return $user->save();
    }
}