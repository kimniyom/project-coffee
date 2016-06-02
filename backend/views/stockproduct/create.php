<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Stockproduct */

$this->title = 'เพิ่มข้อมูลสินค้า';
$this->params['breadcrumbs'][] = ['label' => 'สินค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stockproduct-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel,
    ])
    ?>

</div>
