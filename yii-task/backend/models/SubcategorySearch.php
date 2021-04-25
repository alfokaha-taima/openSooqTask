<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Subcategory;

/**
 * SubcategorySearch represents the model behind the search form of `backend\models\Subcategory`.
 */
class SubcategorySearch extends Subcategory
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subcategories_id', 'categories_id'], 'integer'],
            [['subcategory_name'], 'safe'],
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
        $query = Subcategory::find();

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
            'subcategories_id' => $this->subcategories_id,
            'categories_id' => $this->categories_id,
        ]);

        $query->andFilterWhere(['like', 'subcategory_name', $this->subcategory_name]);

        return $dataProvider;
    }
}
