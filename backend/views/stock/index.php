<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Stockproduct;
use app\models\Category;
use app\models\Unit;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use common\models\System;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'สต๊อกสินค้า';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-index">

    <h1><i class="fa fa-check-circle-o text-green"></i> <?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);     ?>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i> เพิ่มสต๊อก', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="panel panel-default">
        <div class="panel-heading">
            Stocks 
            <?php if ($countLock > 0) { ?>

                <button type="button" class="btn btn-danger btn-xs pull-right"
                        onclick="lock('Y')"><i class="fa fa-lock"></i> Lock</button>
                    <?php } else { ?>
                <button type="button" class="btn btn-info btn-xs pull-right"
                        onclick="lock('N')"><i class="fa fa-unlock"></i> UnLock</button>
            <?php } ?>
        </div>
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
                        'filter' => ArrayHelper::map($filterP, 'id', 'productname'),
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
                                'filter' => ArrayHelper::map(Category::find()->where(['status' => '1'])->orderBy('id')->asArray()->all(), 'id', 'cat_name'),
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
                                                'attribute' => 'total',
                                                'header' => 'คงเหลือ',
                                                'hAlign' => 'center',
                                                'value' => function($model) {
                                                    if ($model->total <= 0) {
                                                        $color = "<span style='color:red;'>" . $model->total . "</span>";
                                                    } else {
                                                        $color = $model->total;
                                                    }

                                                    return $color;
                                                },
                                                'format' => 'raw'
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
                                                'label' => 'actions',
                                                'hAlign' => 'center',
                                                'format' => 'raw',
                                                'value' => function($model) {
                                                    $str = "<center><a href='" . Url::to(['stock/view', 'id' => $model->id]) . "'><i class='fa fa-eye'></i></a> ";
                                                    if ($model->lock == 'N' && $model->total > 0) {
                                                        $str .= " <a href='" . Url::to(['stock/update', 'id' => $model->id]) . "'><i class='fa fa-pencil'></i></a></center>";
                                                    } else {
                                                        $str .= "<i class='fa fa-pencil'></i></center>";
                                                    }
                                                    //$str .= " <a href='" . Url::to(['stock/update', 'id' => $model->id]) . "'><i class='fa fa-trash'></i></a></center>";
                                                    return $str;
                                                }
                                                    ],
                                                    [
                                                        //'label' => '<button type="button" class="btn btn-default btn-xs">lockAll</button>',
                                                        'hAlign' => 'center',
                                                        'format' => 'raw',
                                                        'value' => function($model) {
                                                            if ($model->lock == 'N') {
                                                                return Html::a('<i class="fa fa-trash"></i> Delete', ['delete', 'id' => $model->id], [
                                                                            'class' => 'btn btn-danger btn-xs',
                                                                            'data' => [
                                                                                'confirm' => 'Are you sure you want to delete this item?',
                                                                                'method' => 'post',
                                                                            ],
                                                                ]);
                                                                //$str = "<center><a href='" . Url::to(['stock/view', 'id' => $model->id]) . "' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i> Delete</a> ";
                                                                //$str .= "</center>";
                                                            } else {
                                                                $str = "<center><button type='button' class='btn btn-default btn-xs disabled'><i class='fa fa-trash'></i> Delete</button> ";
                                                                $str .= "</center>";
                                                                return $str;
                                                            }
                                                        }
                                                            ],
                                                                /*
                                                                  [
                                                                  'class' => 'yii\grid\ActionColumn',
                                                                  'template' => '{view} {update} {delete}',
                                                                  'header' => 'Actions',
                                                                  'headerOptions' => ['style' => 'text-align:center;'],
                                                                  'contentOptions' => ['style' => 'text-align:center;'],
                                                                  ],
                                                                 * 
                                                                 */
                                                        ];

                                                        echo GridView::widget([
                                                            'dataProvider' => $dataProvider,
                                                            'filterModel' => $searchModel,
                                                            'columns' => $columns,
                                                        ]);
                                                        ?>
                                                    </div>
                                                </div>

                                                <script type="text/javascript">
                                                    function lock(status) {
                                                        var url = "<?php echo Url::to(['stock/lock']) ?>";
        var data = {status: status};
        $.post(url, data, function () {
            window.location.reload();
        });
    }
</script>
