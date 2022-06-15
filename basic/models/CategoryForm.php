<?php

namespace app\models;

use yii\base\Model;

class CategoryForm extends Model
{
//    public $name;
//    public $email;
    public $category;

    public function rules()
    {
        return [
            [['category'], 'required']
//            ['email', 'email'],
        ];
    }
}