<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Tables */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tables-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tables')->textInput() ?>

    <?= $form->field($model, 'comment')->textarea([
        'maxlength' => true,
        'rows' => 5
        ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
