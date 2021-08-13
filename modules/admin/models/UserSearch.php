<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\User;

/**
 * UserSearch represents the model behind the search form of `app\modules\users\models\User`.
 */
class UserSearch extends User
{
    /**
     * {@inheritdoc}
     */
    public function rules() // Правила валидации
    {
        return [
            [['id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['username', 'auth_key', 'email_confirm_token', 'password_hash', 'password_reset_token', 'email'], 'safe'],
        ];
    }
/*
    public function attributeLabels() // Значение атрибутов
    {
        return [
            'id'                  => Yii::t('app', 'ATTRIBUTE_USER_ID'),
            'created_at'          => Yii::t('app', 'ATTRIBUTE_USER_CREATED_AT'),
            'updated_at'          => Yii::t('app', 'ATTRIBUTE_USER_UD_DATED_AT'),
            'username'            => Yii::t('app', 'ATTRIBUTE_USER_USERNAME'),
            'auth_key'            => Yii::t('app', 'ATTRIBUTE_AUTH_KEY'),
            'email_confirm_token' => Yii::t('app', 'ATTRIBUTE_EMAIL_CONFIRM_TOKEN'),
            'password_hash'       => Yii::t('app', 'ATTRIBUTE_PASSWORD_HASH'),
            'password_reset_token'=> Yii::t('app', 'ATTRIBUTE_PASSWORD_RESET_TOKEN'),
            'email'               => Yii::t('app', 'ATTRIBUTE_USER_EMAIL'),
            'status'              => Yii::t('app', 'ATTRIBUTE_USER_STATUS'),
        ];
    }
*/
    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'email_confirm_token', $this->email_confirm_token])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
