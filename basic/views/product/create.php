<?php

use app\models\Product;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $model Product */
/** @var integer $receipt_id */

$this->title = 'Новый продукт';
$this->params['breadcrumbs'][] = ['label' => 'Продукт', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'receipt_id' => $receipt_id,
    ]) ?>

</div>