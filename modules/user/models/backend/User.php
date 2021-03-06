<?php

namespace app\modules\user\models\backend;

use app\modules\user\Module;
use yii\helpers\ArrayHelper;

class User extends \app\modules\user\models\User // Наследует от модели User модуля User
{
    const SCENARIO_ADMIN_CREATE = 'adminCreate'; // Сценарий Создание Админа
    const SCENARIO_ADMIN_UPDATE = 'adminUpdate'; // Сценарий Изменений Админа

    public $newPassword;       // Новый пароли
    public $newPasswordRepeat; // Новый пароль (повтор)

    public function rules() // Правила валидации
    {
        return ArrayHelper::merge(parent::rules(), [
            [['newPassword', 'newPasswordRepeat'], 'required', 'on' => self::SCENARIO_ADMIN_CREATE],
            ['newPassword', 'string', 'min' => 6],
            ['newPasswordRepeat', 'compare', 'compareAttribute' => 'newPassword'],
        ]);
    }

    public function scenarios() // Сценарии
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_ADMIN_CREATE] = ['username', 'email', 'status', 'newPassword', 'newPasswordRepeat'];
        $scenarios[self::SCENARIO_ADMIN_UPDATE] = ['username', 'email', 'status', 'newPassword', 'newPasswordRepeat'];
        return $scenarios;
    }

    public function attributeLabels() // Значение атрибутов
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'newPassword'       => Module::t('module', 'ATTRIBUTE_USER_NEW_PASSWORD'),
            'newPasswordRepeat' => Module::t('module', 'ATTRIBUTE_USER_REPEAT_PASSWORD'),
        ]);
    }

    public function beforeSave($insert) // Действие перед сохранением
    {
        if (parent::beforeSave($insert)) {
            if (!empty($this->newPassword)) {
                $this->setPassword($this->newPassword);
            }
            return true;
        }
        return false;
    }
}