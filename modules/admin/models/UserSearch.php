<?php

namespace app\modules\admin\models;

use app\modules\admin\Module;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserSearch представляет собой модель, лежащую в основе формы поиска «app \ modules \ users \ models \ User».
 */
class UserSearch extends Model
{
    public $id;        // ID
    public $username;  // Имя пользователя
    public $email;     // E-mail
    public $status;    // Статус
    public $date_from; // Дата создания
    public $date_to;   // Дата изменения

    /**
     * {@inheritdoc}
     */
    public function rules() // Правила валидации
    {
        return [
            [['id', 'status'], 'integer'],
            [['username', 'email'], 'safe'],
            [['date_from', 'date_to'], 'date', 'format' => 'php:Y-m-d'],
        ];
    }

    public function attributeLabels() // Значение атрибутов
    {
        return [
            'id'                  => Module::t('module', 'ATTRIBUTE_USER_ID'),
            'created_at'          => Module::t('module', 'ATTRIBUTE_USER_CREATED_AT'),
            'updated_at'          => Module::t('module', 'ATTRIBUTE_USER_UD_DATED_AT'),
            'username'            => Module::t('module', 'ATTRIBUTE_USER_USERNAME'),
            //'auth_key'            => Module::t('module', 'ATTRIBUTE_AUTH_KEY'),
            //'email_confirm_token' => Module::t('module', 'ATTRIBUTE_EMAIL_CONFIRM_TOKEN'),
            //'password_hash'       => Module::t('module', 'ATTRIBUTE_PASSWORD_HASH'),
            //'password_reset_token'=> Module::t('module', 'ATTRIBUTE_PASSWORD_RESET_TOKEN'),
            'email'               => Module::t('module', 'ATTRIBUTE_USER_EMAIL'),
            'status'              => Module::t('module', 'ATTRIBUTE_USER_STATUS'),
            'date_from'           => Module::t('module', 'ATTRIBUTE_USER_DATE_FROM'),
            'date_to'             => Module::t('module', 'ATTRIBUTE_USER_DATE_TO'),
        ];
    }

    /**
     * Создает экземпляр поставщика данных с примененным поисковым запросом
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();

        // Добавьте здесь условия, которые всегда должны применяться

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [ // Сортировка по убыванию id
                'defaultOrder' => ['id' => SORT_DESC],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // Раскомментируйте следующую строку, если вы не хотите возвращать какие-либо записи в случае сбоя проверки
            $query->where('0=1');
            return $dataProvider;
        }

        // Условия фильтрации сетки
        $query->andFilterWhere([
            'id' => $this->id,
            //'created_at' => $this->created_at,
            //'updated_at' => $this->updated_at,
            'status' => $this->status,
        ]);

        $query
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['>=', 'created_at', $this->date_from ? strtotime($this->date_from . ' 00:00:00') : null])
            ->andFilterWhere(['<=', 'created_at', $this->date_to ? strtotime($this->date_to . ' 23:59:59') : null]);

        return $dataProvider;
    }
}
