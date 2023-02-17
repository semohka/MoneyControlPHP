<?php

namespace app\controllers;

use app\models\ProductCategorySearch;
use yii\web\Controller;

class ProductCategoryController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new ProductCategorySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}