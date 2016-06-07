<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderlistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orderlists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orderlist-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Orderlist', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'order',
            'menu',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
