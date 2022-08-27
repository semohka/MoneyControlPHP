<?php
/* @var $this View */

/* @var $model Receipt|null */

use app\models\Receipt;
use yii\helpers\Html;
use yii\web\View;

$this->title = 'Редактирование чека: ' . $model->shop_id;
$this->params['breadcrumbs'][] = ['label' => 'Чеки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->shop_id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="receipt-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>