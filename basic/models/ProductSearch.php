<?php

namespace app\models;

use yii\data\ActiveDataProvider;

class ProductSearch extends Product
{
    public function rules()
    {
        return [
            [['id', 'count', 'receipt_id', 'category_id'], 'integer'],
            [['title', 'grade', 'comment'], 'string', 'max' => 40],
            [['price_of_one', 'total_price'], 'double'],
            [['screenshot'], 'string', 'max' => 40],
        ];
    }

    public function search(array $params)
    {
        $query = Product::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
//            'title' => $this->title,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }

}