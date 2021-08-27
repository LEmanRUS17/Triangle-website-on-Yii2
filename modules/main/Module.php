<?php

namespace app\modules\main;

use Yii;
/**
 * main module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\main\controllers';

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
        return Yii::t('modules/admin/' . $category, $message, $params, $language);
    }
}
