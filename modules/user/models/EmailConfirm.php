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
        throw new InvalidArgumentException(Yii::t('app', 'ERROR_MISSING_CONFIRMATION_CODE'));
        }
        $this->_user = User::findByEmailConfirmToken($token);
        if (!$this->_user) {
        throw new InvalidArgumentException(Yii::t('app', 'ERROR_INVALID_TOKEN'));
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