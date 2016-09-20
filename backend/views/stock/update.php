<?php

use yii\helpers\Html;
use app\models\Stockproduct;

/* @var $this yii\web\View */
/* @var $model app\models\Stock */
$productname = Stockproduct::find()->where(['id' => $model->product])->one()->productname;
$this->title = 'แก้ไข Stock: ' . $productname;
$this->params['breadcrumbs'][] = ['label' => 'Stocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $productname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="stock-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'product' => $product,
        'type' => '1',
    ])
    ?>

</div>
