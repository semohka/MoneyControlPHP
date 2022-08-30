<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $title
 * @property double $price_of_one
 * @property double $total_price
 * @property int $count
 * @property string $grade
 * @property int $receipt_id
 * @property int $category_id
 * @property string $comment [varchar(40)]
 * @property string $screenshot [varchar(40)]
 */
class Product extends ActiveRecord
{
    public static function tableName()
    {
        return 'products';
    }

    public function rules()
    {
        return [
            [['title', 'price_of_one', 'total_price', 'count', 'grade', 'receipt_id', 'category_id'], 'required'],
            [['title', 'grade', 'comment'], 'string', 'max' => 40],
            [['price_of_one'], 'double'],
            [['total_price'], 'double'],
            [['count'], 'integer'],
            [['screenshot'], 'string', 'max' => 40],
            [['receipt_id'], 'integer'],
            [['category_id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Продукт',
            'price_of_one' => 'Цена за единицу',
            'total_price' => 'Цена',
            'count' => 'Количество',
            'grade' => 'Оценка',
            'comment' => 'Комментарий',
            'screenshot' => 'Фото чека',
            'receipt_id' => 'Номер чека',
            'category_id' => 'Категория',
        ];
    }
}