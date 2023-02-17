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

    <div class="container">
        <div class="row">
            <div class="col">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col">
                <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map($product_categories, 'id', 'title')) ?>
            </div>
            <div class="col">
                <?= $form->field($model, 'count')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?= $form->field($model, 'price_of_one')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col">
                <?= $form->field($model, 'total_price')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col">
                <?= $form->field($model, 'grade')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col">
                <?= $form->field($model, 'screenshot')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </div>
    <?= $form->field($model, 'receipt_id')->textInput()->hiddenInput(['value' => $receipt_id])->label('') ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>