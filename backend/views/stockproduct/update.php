<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Stockproduct */

$this->title = 'แก้ไขข้อมูลสินค้า: ' . $model->productname;
$this->params['breadcrumbs'][] = ['label' => 'สินค้ทั้งหมด', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->productname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="stockproduct-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel
    ])
    ?>

</div>
