<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "shops".
 *
 * @property int $id
 * @property string $title
 */
class ProductCategory extends ActiveRecord
{
    public static function tableName()
    {
        return 'product_categories';
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 40],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
        ];
    }
}