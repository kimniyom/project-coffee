<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Menuoptions */

$this->title = 'Create Menuoptions';
$this->params['breadcrumbs'][] = ['label' => 'Menuoptions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menuoptions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
