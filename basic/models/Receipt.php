<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "receipts".
 *
 * @property int $id
 * @property int $shop_id
 * @property string $date
 */
class Receipt extends ActiveRecord
{
    public static function tableName()
    {
        return 'receipts';
    }

    public function rules()
    {
        return [
            [['shop_id', 'date'], 'required'],
            [['shop_id'], 'integer'],
            [['date'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shop_id' => 'Магазин',
            'date' => 'Дата создания'
        ];
    }

}

