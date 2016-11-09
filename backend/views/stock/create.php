<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Stock */

$this->title = 'เพิ่ม Stock';
$this->params['breadcrumbs'][] = ['label' => 'Stocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-create">

    <h1 class="text-green"><i class="fa fa-plus-circle"></i> <?= Html::encode($this->title) ?></h1>
    <?=
    $this->render('_form', [
        'model' => $model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'product' => [],
        'type' => '0',
    ])
    ?>

</div>
