<?php

namespace app\modules\blog\models\backend;

use app\modules\blog\Module;
use Yii;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $content
 * @property string|null $date
 * @property string|null $viewed
 * @property string|null $status
 * @property string|null $category_id
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * Имя используемой таблицы
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * Правила валидации
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['title', 'description', 'content'], 'string', 'max' => 255],
            [['viewed', 'status', 'category_id'], 'string', 'max' => 11],
        ];
    }

    /**
     * Атрибуты
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'          => Module::t('module', 'ARTICLE_MODEL_ID'),
            'title'       => Module::t('module', 'ARTICLE_MODEL_TITLE'),
            'description' => Module::t('module', 'ARTICLE_MODEL_DESCRIPTION'),
            'content'     => Module::t('module', 'ARTICLE_MODEL_CONTENT'),
            'date'        => Module::t('module', 'ARTICLE_MODEL_DATE'),
            'viewed'      => Module::t('module', 'ARTICLE_MODEL_VIEWED'),
            'status'      => Module::t('module', 'ARTICLE_MODEL_STATUS'),
            'category_id' => Module::t('module', 'ARTICLE_MODEL_CATEGORY_ID'),
        ];
    }
}
