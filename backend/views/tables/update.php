<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tables */

$this->title = 'แก้ไขโต๊ะหมายเลข: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'โต๊ะอาหาร', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'โต๊ะที่ '.$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="tables-update">
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo $this->title ?></div>
        <div class="panel-body">

            <?=
            $this->render('_form', [
                'model' => $model,
            ])
            ?>
        </div>
    </div>
</div>
