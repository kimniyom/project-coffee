<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Type */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'typename')->textInput(['maxlength' => true]) ?>
    <?=
    $form->field($model, 'options')->dropdownList(
            [
                '0' => 'No',
                '1' => 'Yes'
                ], [
        'prompt' => '== กรุณาเลือก =='
    ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
