<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\form\ActiveForm;
use kartik\widgets\Widget;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form">

    <?php
    $form = ActiveForm::begin([
                'type' => ActiveForm::TYPE_VERTICAL,
                'formConfig' => ['labelSpan' => 2, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]);
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'resgister')->textInput()   ?>


    <?= $form->field($model, 'salary')->textInput() ?>

    <?php
    // Usage with model and Active Form (with no default initial value)
    echo $form->field($model, 'resgister')->widget(DatePicker::classname(), [
        'options' => [
            'placeholder' => 'Enter birth date ...',
            'value' => date('Y-m-d'),
        ],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]);
    ?>
    <div class="form-group" style=" margin-top: 20px;">
        <div class="row">
            <div class="col-sm-2 col-md-2 col-lg-2" style="padding-left: 28px;"></div>
            <div class="col-sm-10 col-md-10 col-lg-10" style="padding-left: 25px;">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
