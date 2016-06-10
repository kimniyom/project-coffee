<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Menuoptions */

$this->title = 'Update : ' . $model->options;
$this->params['breadcrumbs'][] = ['label' => 'Menuoptions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->options, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="menuoptions-update">
    <div class="panel panel-default">
        <div class="panel-heading"><h4><?= Html::encode($this->title) ?></h4></div>
        <div class="panel-body">
            <?=
            $this->render('_form', [
                'model' => $model,
            ])
            ?>
        </div>
    </div>
</div>
