<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */

$this->title = 'Update Employee: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'พนักงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="employee-update">
    <div class="panel panel-default">
        <div class="panel-heading"><?= Html::encode($this->title) ?></div>

        <div class="panel-body">


            <?=
            $this->render('_form', [
                'model' => $model,
            ])
            ?>
        </div>
    </div>
</div>
