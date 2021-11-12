<?php

namespace app\modules\blog;

use Yii;

/**
 * blog module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\blog\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

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
