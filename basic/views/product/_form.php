<?php

use app\models\ProductCategory;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
/** @var integer $receipt_id */
$product_categories = ProductCategory::find()->all();
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
    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map($product_categories, 'id', 'title')) ?>
    <?= $form->field($model, 'receipt_id')->textInput()->hiddenInput(['value' => $receipt_id])->label('') ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>