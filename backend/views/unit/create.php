<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Unit */

$this->title = 'เพิ่มหน่วยนับ';
$this->params['breadcrumbs'][] = ['label' => 'หน่วยนับ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
