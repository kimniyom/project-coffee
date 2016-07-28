<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Setting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="setting-form">

    <?php
    $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data'],
                //'type' => ActiveForm::TYPE_HORIZONTAL,
                'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]);
    ?>

    <?= $form->field($model, 'shopname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'defaulttable')->dropDownList([ 1 => 'แบบเลือกโต๊ะ', 0 => 'แบบไม่เลือกโต๊ะ',], ['prompt' => 'เลือกรูปแบบการขาย']) ?>
    <div class="row">
        <div class="col-md-3 col-lg-3"></div>
        <div class="col-md-2 col-lg-2" style="padding-left: 25px;">
            <div class="well text-center">
                <?= Html::img($model->getPhotoViewer(), ['style' => 'width:100px;', 'class' => 'img-rounded']); ?>
            </div>

        </div>
    </div>
    <?= $form->field($model, 'logo')->fileInput() ?>
    <?php
    //$form->field($model, 'logo')->textInput(['maxlength' => true]) 
    ?>

    <?= $form->field($model, 'wifi')->textInput(['maxlength' => true]) ?>
    <div class="row">
        <div class="col-md-3 col-lg-3"></div>
        <div class="col-md-2 col-lg-2" style="padding-left: 25px;">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
