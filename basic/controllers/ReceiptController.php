<?php

namespace app\controllers;

use app\models\Receipt;
use yii\web\Controller;

class ReceiptController extends Controller
{
    public function actionIndex()
    {
        $query = Receipt::findAll();
    }

    public function actionCreate()
    {
        $model = new Receipt();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $model->loadDefaultValues();
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }
}