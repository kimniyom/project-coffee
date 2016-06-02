<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Type */

$this->title = 'แก้ไข : ' . $model->typename;
$this->params['breadcrumbs'][] = ['label' => 'ประเภท', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->typename, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="type-update">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><?= Html::encode($this->title) ?></h4>
        </div>
        <div class="panel-body">

            <?=
            $this->render('_form', [
                'model' => $model,
            ])
            ?>
        </div>
    </div>
</div>
