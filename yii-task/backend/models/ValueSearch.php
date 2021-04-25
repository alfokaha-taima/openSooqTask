<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Value;

/**
 * ValueSearch represents the model behind the search form of `backend\models\Value`.
 */
class ValueSearch extends Value
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value_id', 'field_id', 'optionValue_id', 'post_id', 'value(int)'], 'integer'],
            [['value(varchar)', 'value(date)'], 'safe'],
        ];
    }

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
        $query = Value::find();

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
            'value_id' => $this->value_id,
            'field_id' => $this->field_id,
            'optionValue_id' => $this->optionValue_id,
            'post_id' => $this->post_id,
            'value(int)' => $this->value(int),
            'value(date)' => $this->value(date),
        ]);

        $query->andFilterWhere(['like', 'value(varchar)', $this->value(varchar)]);

        return $dataProvider;
    }
}
