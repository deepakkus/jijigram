<?php

namespace admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use admin\models\User;

/**
 * UserSearch represents the model behind the search form about `manage\models\user`.
 */
class UserSearch extends user
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'phone_no', 'created_at', 'updated_at', 'loc_lat', 'loc_long'], 'integer'],
            [['username', 'first_name', 'last_name', 'gender', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'status','usertype','address2', 'country', 'city','state', 'nation','province', 'zip', 'user_pic', 'user_details', 'skill_level', 'preferred_golf_course', 'other_courses', 'travel_mile_limit', 'available_date_range'], 'safe'],
			
			[['address1'],'required'],
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
        $query = user::find();

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
            'phone_no' => $this->phone_no,
            'dob' => $this->dob,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'loc_lat' => $this->loc_lat,
            'loc_long' => $this->loc_long,
            'available_date_range' => $this->available_date_range,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'address1', $this->address1])
			->andFilterWhere(['like', 'usertype', $this->usertype])
            ->andFilterWhere(['like', 'address2', $this->address2])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'city', $this->city])
		   ->andFilterWhere(['like', 'state', $this->state])
           ->andFilterWhere(['like', 'nation', $this->nation])
		   ->andFilterWhere(['like', 'province', $this->province])
            ->andFilterWhere(['like', 'zip', $this->zip])
            ->andFilterWhere(['like', 'user_pic', $this->user_pic])
            ->andFilterWhere(['like', 'user_details', $this->user_details])
            ->andFilterWhere(['like', 'skill_level', $this->skill_level])
            ->andFilterWhere(['like', 'preferred_golf_course', $this->preferred_golf_course])
            ->andFilterWhere(['like', 'other_courses', $this->other_courses])
            ->andFilterWhere(['like', 'travel_mile_limit', $this->travel_mile_limit]);

        return $dataProvider;
    }
}
