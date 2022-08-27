<?php
/* @var $this View */

/* @var $model Receipt */

use app\models\Receipt;
use yii\helpers\Html;
use yii\web\View;

$this->title = 'Новый  чек';
$this->params['breadcrumbs'][] = ['label' => 'Чеки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="receipt-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
