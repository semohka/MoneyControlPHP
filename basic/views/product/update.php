<?php

/* @var $this View */

/* @var $model Product|null */

/** @var integer $receipt_id */

use app\models\Product;
use yii\helpers\Html;
use yii\web\View;

$this->title = 'Редактирование продукта: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Продукты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';

?>
<div class="product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'receipt_id' => $model->receipt_id,
    ]) ?>

</div>