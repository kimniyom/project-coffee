<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;
use kartik\grid\GridView;
use app\models\Category;
use app\models\Unit;

/* @var $this yii\web\View */
/* @var $model app\models\Stockproduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stockproduct-form">

    <?php
    $form = ActiveForm::begin([
                    /* 'id' => 'login-form-vertical',
                      'type' => ActiveForm::TYPE_INLINE,
                      'formConfig' => ['showErrors' => true]
                     * 
                     */
    ]);
    ?>
    <div class="row">
        <div class="col-md-5 col-lg-5">
            <?= $form->field($model, 'productname')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3 col-lg-3">
            <?php
            echo $form->field($model, 'category')->dropDownList(ArrayHelper::map(app\models\Category::find()->all(), 'id', 'cat_name'), ['id' => 'id', 'required' => 'required', 'prompt' => 'เลือกหมวด',
                    /*
                      'pluginOptions' => [
                      'allowClear' => true
                      ],
                     * 
                     */
            ]);
            ?>
        </div>
        <div class="col-md-2 col-lg-2">
            <?php
            echo $form->field($model, 'unit')->dropDownList(ArrayHelper::map(app\models\Unit::find()->all(), 'id', 'unit'), ['id' => 'id', 'required' => 'required', 'prompt' => 'หน่วยนับ',
                    /*
                      'pluginOptions' => [
                      'allowClear' => true
                      ],
                     * 
                     */
            ]);
            ?>
        </div>
        <div class="col-md-2 col-lg-2">
            <?php
            echo Html::submitButton($model->isNewRecord ?
                            '<i class="glyphicon glyphicon-plus"></i> บันทึก' :
                            '<i class="glyphicon glyphicon-pencil"></i> แก้ไข', ['class' => $model->isNewRecord ?
                        'btn btn-success btn-block' : 'btn btn-primary btn-block',
                'style' => 'margin-top:25px;']
            )
            ?>
        </div>
    </div>


    <?php ActiveForm::end(); ?>
    <div class="panel panel-default">
        <div class="panel-heading">สินค้า</div>
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
                            'value' => function($model) {
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
