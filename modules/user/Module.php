<?php

namespace app\modules\user;

use Yii;
/**
 * main module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\user\controllers';

    public $defaultRole = 'user';

    /**
     * @var int
     */
    public $emailConfirmTokenExpire = 259200; // 3 days
    /**
     * @var int
     */
    public $passwordResetTokenExpire = 3600;

    /**
     * Вспомогательная функция для перевода
     * @param $category      // Категория сообщения
     * @param $message       // Сообщение которое нужно перевести
     * @param array $params  // Список параметров
     * @param null $language // Язык перевода
     * @return string        // Переведенная строка
     */
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/user/' . $category, $message, $params, $language);
    }
}
