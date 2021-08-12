<?php

namespace app\modules\user\models;

use yii\base\Model;
use yii\db\ActiveQuery;
use Yii;

class ProfileUpdateForm extends Model
{
    public $email;

    /**
     * @var User
     */
    private $_user;

    public function __construct(User $user, $config = [])
    {
        $this->_user = $user;
        $this->email = $user->email;
        parent::__construct($config);
    }

    public function rules() // Правила валидации
    {
        return [
            ['email', 'required'], // Email | Обязательный
            ['email', 'email'],    // Email | Соответствует "email"
            [
                'email',
                'unique',
                'targetClass' => User::class,
                'message' => Yii::t('app', 'ERROR_EMAIL_EXISTS'),
                'filter' => ['<>', 'id', $this->_user->id],
            ],
            ['email', 'string', 'max' => 255], // Email | Строка, максимальная длина 255
        ];
    }

    public function attributeLabels() // Значение атрибутов
    {
        return [
            'email' => Yii::t('app', 'UP_USER_EMAIL'),
        ];
    }

    public function update() // Обновить данные профиля
    {
        if ($this->validate()) {
            $user = $this->_user;
            $user->email = $this->email;
            return $user->save();
        } else {
            return false;
        }
    }
}