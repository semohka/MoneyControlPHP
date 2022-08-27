<?php

namespace app\models;

use yii\data\ActiveDataProvider;

class ReceiptSearch extends Receipt
{
    public function rules()
    {
        return [
            [['id', 'shop_id'], 'integer'],
            [['date'], 'safe'],
        ];
    }

    public function search(array $params)
    {
        $query = Receipt::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['shop_id' => $this->shop_id]);

        return $dataProvider;
    }
}