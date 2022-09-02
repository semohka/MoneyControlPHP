<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'price_of_one')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'total_price')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'count')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'grade')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'screenshot')->textInput(['maxlength' => true]) ?>
    <!--    --><? //= $form->field($model, 'receipt_id')->dropDownList(ArrayHelper::map($receipts, 'id', 'title'))->hiddenInput() ?>
    <!--    --><? //= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map($product_categories, 'id', 'title')) ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>