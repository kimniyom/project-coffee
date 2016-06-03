<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Stockproduct;
use app\models\Category;
use app\models\Unit;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use common\models\System;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stocks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);    ?>

    <p>
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Add Stock', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="panel panel-default">
        <div class="panel-heading">Stocks</div>
        <?php
        $columns = [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'attribute' => 'product',
                'value' => function ($model) {
                    $productModel = new Stockproduct();
                    $product = $productModel->find()->where(['id' => $model->product])->one();
                    return $product->productname;
                },
                        'filterType' => GridView::FILTER_SELECT2,
                        'filter' => ArrayHelper::map(Stockproduct::find()->orderBy('id')->asArray()->all(), 'id', 'productname'),
                        'filterWidgetOptions' => [
                            'pluginOptions' => ['allowClear' => true],
                        ],
                        'filterInputOptions' => ['placeholder' => 'ชื่อสินค้า'],
                        'format' => 'raw',
                        'vAlign' => 'middle',
                    ],
                    [
                        'attribute' => 'category',
                        'value' => function ($model) {
                            $catModel = new Category();
                            $cat = $catModel->find()->where(['id' => $model->category])->one();
                            return $cat->cat_name;
                        },
                                'filterType' => GridView::FILTER_SELECT2,
                                'filter' => ArrayHelper::map(Category::find()->orderBy('id')->asArray()->all(), 'id', 'cat_name'),
                                'filterWidgetOptions' => [
                                    'pluginOptions' => ['allowClear' => true],
                                ],
                                'filterInputOptions' => ['placeholder' => 'หมวด'],
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'number',
                                'header' => 'จำนวน',
                                'hAlign' => 'right',
                                'value' => function ($model) {
                                    $productModel = new Stockproduct();
                                    $unitModel = new Unit();
                                    $unitId = $productModel->find()->where(['id' => $model->product])->one();
                                    $unit = $unitModel->find()->where(['id' => $unitId->unit])->one();
                                    return $model->number . " " . $unit->unit;
                                }
                                    ],
                                    [
                                        'attribute' => 'size',
                                        'header' => 'ขนาด',
                                        'hAlign' => 'right',
                                        'value' => function ($model) {
                                            $unitModel = new Unit();
                                            $unit = $unitModel->find()->where(['id' => $model->size_unit])->one();
                                            return $model->size . " " . $unit->unit;
                                        }
                                            ],
                                            [
                                                'attribute' => 'total_cut',
                                                'header' => 'จำนวนที่ตัดได้ / หน่วย',
                                                'hAlign' => 'center',
                                            ],
                                            [
                                                'attribute' => 'create_date',
                                                'hAlign' => 'center',
                                                'value' => function($model) {
                                                    $config = new System();
                                                    return $config->Thaidate($model->create_date);
                                                }
                                            ],
                                            [
                                                'class' => 'yii\grid\ActionColumn',
                                                'template' => '{view} {update} {delete}',
                                                'header' => 'Actions',
                                                'headerOptions' => ['style' => 'text-align:center;'], // not max-width
                                                'contentOptions' => ['style' => 'text-align:center;'], // not max-width
                                            ],
                                        ];

                                        echo GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => $columns,
                                        ]);
                                        ?>
    </div>
</div>
