<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MixSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mixes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mix-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Mix', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'menu',
            'product_stock_id',
            'create_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
