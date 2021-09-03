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
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules() // Правила валидации
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'password' => Module::t('module', 'USER_NEW_PASSWORD'),
        ];
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();
        $user->generateAuthKey();

        return $user->save(false);
    }
}