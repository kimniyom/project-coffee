<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TablesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'โต๊ะอาหาร';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tables-index">

    <h1><?= Html::encode($this->title) ?></h1>
<?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
<?= Html::a('เพิ่มโต๊ะอาหาร', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><?= Html::encode($this->title) ?></h4>
        </div>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'id',
                'tables',
                'comment',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'headerOptions' => ['style' => 'text-align:center;'],
                    'contentOptions' => ['style' => 'text-align:center;'],
                    ],
            ],
        ]);
        ?>
    </div>
</div>
