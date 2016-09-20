<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Setting */

$this->title = 'แก้ไขข้อมูลร้าน';
//$this->params['breadcrumbs'][] = ['label' => 'Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'view', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="setting-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr/>
    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
