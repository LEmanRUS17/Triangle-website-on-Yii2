<?php

namespace app\modules\page;

use Yii;
/**
 * main module definition class
 */
class Module extends \yii\base\Module
{
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
        return Yii::t('modules/page/' . $category, $message, $params, $language);
    }
}
