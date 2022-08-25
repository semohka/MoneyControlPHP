<?php

namespace app\models;

use yii\db\ActiveRecord;

class Receipt extends ActiveRecord
{


    public static function tableName()
    {
        return 'receipt';
    }


}

