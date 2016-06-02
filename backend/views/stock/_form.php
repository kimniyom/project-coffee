<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Category;
use app\models\Stockproduct;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use app\models\Unit;
use kartik\widgets\DatePicker;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Stock */
/* @var $form yii\widgets\ActiveForm */
?>

<hr/>
<div class="stock-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4 col-lg-4">
            <?=
            $form->field($model, 'category')->dropdownList(
                    ArrayHelper::map(Category::find()->all(), 'id', 'cat_name'), [
                'id' => 'ddl-category',
                'prompt' => 'เลือกหมวด'
            ]);
            ?>
        </div>
        <div class="col-md-5 col-lg-5">
            <?=
            $form->field($model, 'product')->widget(DepDrop::classname(), [
                'options' => ['id' => 'ddl-product'],
                'data' => $product,
                'pluginOptions' => [
                    'depends' => ['ddl-category'],
                    'placeholder' => 'เลือกสินค้า...',
                    'url' => Url::to(['/stockproduct/getproduct'])
                ]
            ]);
            ?>
        </div>

        <div class="col-md-3 col-lg-3">
            <?php
            echo $form->field($model, 'create_date')->widget(DatePicker::classname(), [
                'language' => 'th',
                'removeButton' => false,
                'options' => [
                    'value' => date("Y-m-d"),
                    'readonly' => true,
                //'disabled' => 'disabled',
                ],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                ]
            ]);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2 col-lg-2">
            <?= $form->field($model, 'number')->textInput(['type' => 'number']) ?>
        </div>
        <div class="col-md-3 col-lg-3">
            <?= $form->field($model, 'size')->textInput(['type' => 'number']) ?>
        </div>
        <div class="col-md-2 col-lg-2">
            <?=
            $form->field($model, 'size_unit')->dropdownList(
                    ArrayHelper::map(Unit::find()->all(), 'id', 'unit'), [
                //'id' => 'ddl-unit',
                'prompt' => 'เลือกหน่วยนับ'
            ]);
            ?>
        </div>

        <div class="col-md-2 col-lg-2">
            <?= $form->field($model, 'total_cut')->textInput(['type' => 'number']) ?>
        </div>

        <div class="col-md-3 col-lg-3">
            <div class="form-group">
                <?=
                Html::submitButton($model->isNewRecord ?
                                '<i class="glyphicon glyphicon-floppy-save"></i> Create' : '<i class="glyphicon glyphicon-pencil"></i> Update', [
                    'class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block',
                    'style' => 'margin-top:25px;'
                        ]
                )
                ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><?php echo $this->title ?></div>
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
                                        'attribute' => 'total_cut',
                                        'header' => 'จำนวนที่ตัดได้ / หน่วย',
                                        'hAlign' => 'center',
                                    ],
                                    [
                                        'attribute' => 'create_date',
                                        'hAlign' => 'center',
                                    ],
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{update} {delete}',
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

