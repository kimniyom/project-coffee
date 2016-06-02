<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use app\models\Category;
use app\models\Unit;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'สินค้า';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stockproduct-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

    <p>
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> เพิ่มสินค้า', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </p>
    <div class="panel panel-default">
        <div class="panel-heading"><?= Html::encode($this->title) ?></div>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'id',
                'productname',
                [
                    'attribute' => 'category',
                    'value' => function ($model, $key, $index, $widget) {
                        $cat = new Category();
                        $catRs = $cat->find()->where(['id' => $model->category])->one();
                        return $catRs->cat_name;
                    },
                            'vAlign' => 'middle',
                            'format' => 'raw',
                        ],
                            [
                                'attribute' => 'unit',
                                'format' => 'raw',
                                'value' => function($model){
                                    $unit = Unit::find()->where(['id' => $model->unit])->one();
                                    return $unit->unit;
                                }
                            ],
                        // 'create_date',
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]);
                ?>
    </div>
</div>
