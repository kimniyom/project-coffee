<?php

use yii\helpers\Html;
use kartik\grid\GridView;

//use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MenuoptionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menuoptions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menuoptions-index">

<?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
<?= Html::a('Create Menuoptions', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="panel panel-default">
        <div class="panel-heading"><h4><?= Html::encode($this->title) ?></h4></div>
        <div class="panel-body">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'id',
                    'options',
                    'price',
                    'create_date',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
        </div>
    </div>
</div>
