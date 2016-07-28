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
use common\models\System;

/* @var $this yii\web\View */
/* @var $model app\models\Stock */
/* @var $form yii\widgets\ActiveForm */
?>

<hr/>
<div class="stock-form">
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
        <div class="col-md-4 col-lg-4">
            <?=
            $form->field($model, 'category')->dropdownList(
                    ArrayHelper::map(Category::find()->where(['status' => '1'])->all(), 'id', 'cat_name'), [
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
        <div class="col-md-2 col-lg-2">
            <?= $form->field($model, 'total')->textInput([
                'type' => 'number',
                'id' => 'type',
                ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 col-lg-2">
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
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php 
    $this->registerJs('
        $(document).ready(function(){
            var type = '.$type.';
            if(type == 0){
                $("#type").attr("disabled",true);
            } else {
                $("#type").attr("disabled",false);
            }
        });
            ');

?>




