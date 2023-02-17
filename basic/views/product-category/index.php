<?php


/* @var $this View */
/* @var $searchModel ProductCategorySearch */

/* @var $dataProvider ActiveDataProvider */

use app\models\ProductCategory;
use app\models\ProductCategorySearch;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Магазины';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="shop-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать магазин', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'title',
        [
            'class' => ActionColumn::class,
            'urlCreator' => function ($action, ProductCategory $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id]);
            }
        ],
    ],
]); ?>