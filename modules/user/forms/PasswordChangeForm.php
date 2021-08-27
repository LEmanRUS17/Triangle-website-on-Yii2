<?php

namespace app\modules\user\forms;

use app\modules\user\models\User;
use app\modules\user\Module;
use Yii;
use yii\base\Model;


/**
 * Форма смены пароля
 */
class PasswordChangeForm extends Model
{
    public $currentPassword;   // Текущий пароль
    public $newPassword;       // Новый пароль
    public $newPasswordRepeat; // Новый пароль (веденный повторно)

    /**
     * @var User
     */
    private $_user; // Пользователь

    /**
     * @param User $user
     * @param array $config
     */
    public function __construct(User $user, $config = [])
    {
        $this->_user = $user;
        parent::__construct($config);
    }

    public function rules() // Правила валидации
    {
        return [
            [['currentPassword', 'newPassword', 'newPasswordRepeat'], 'required'], // Текущий пароль, Новый пароль, Новый пароль (веденный повторно) | Обязательно
            ['currentPassword', 'currentPassword'],                                // Текущий пароль                                                 |
            ['newPassword', 'string', 'min' => 6],                                 // Новый пароль                                                   | Строка, минимальная длина 6
            ['newPasswordRepeat', 'compare', 'compareAttribute' => 'newPassword'], // Новый пароль, Новый пароль (веденный повторно)                 | Должны быть одинаковыми
        ];
    }

    public function attributeLabels() // Значение атрибутов
    {
        return [
            'newPassword'       => Module::t('module', 'UP_USER_PASSWORD_NEW_PASSWORD'),
            'newPasswordRepeat' => Module::t('module', 'UP_USER_PASSWORD_REPEAT_PASSWORD'),
            'currentPassword'   => Module::t('module', 'UP_USER_PASSWORD_CURRENT_PASSWORD'),
        ];
    }

    /**
     * @param string $attribute
     * @param array $params
     */
    public function currentPassword($attribute, $params) // Проверка действующего пароля
    {
        if (!$this->hasErrors()) {
            if (!$this->_user->validatePassword($this->$attribute)) {
                $this->addError($attribute, Module::t('module', 'ERROR_WRONG_CURRENT_PASSWORD'));
            }
        }
    }

    /**
     * @return boolean
     */
    public function changePassword() // Изменение пароля
    {
        if ($this->validate()) {
            $user = $this->_user;
            $user->setPassword($this->newPassword);
            return $user->save();
        } else {
            return false;
        }
    }
}