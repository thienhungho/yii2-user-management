<?php

namespace thienhungho\UserManagement\modules\UserManage\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use thienhungho\UserManagement\modules\UserBase\User;

/**
 * thienhungho\UserManagement\modules\UserManage\search\UserSearch represents the model behind the search form about `thienhungho\UserManagement\modules\UserBase\User`.
 */
 class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'full_name', 'job', 'bio', 'company', 'tax_number', 'address', 'avatar', 'phone', 'birth_date', 'facebook_url'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'birth_date' => $this->birth_date,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'job', $this->job])
            ->andFilterWhere(['like', 'bio', $this->bio])
            ->andFilterWhere(['like', 'company', $this->company])
            ->andFilterWhere(['like', 'tax_number', $this->tax_number])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'avatar', $this->avatar])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'facebook_url', $this->facebook_url]);

        return $dataProvider;
    }
}
