<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tables */

$this->title = 'เพิ่มโต๊ะอาหาร';
$this->params['breadcrumbs'][] = ['label' => 'โต๊ะอาหาร', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
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
