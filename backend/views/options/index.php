<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\System;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OptionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Options';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="options-index">

    <h1><?= Html::encode($this->title) ?></h1>
<?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
    <?= Html::a('Create Options', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'menu',
            'options',
            [
                'attribute' => 'create_date',
                'label' => 'วันที่',
                'value' => function($model) {
                    $config = new System();
                    return $config->Thaidate($model->create_date);
                }
            ],
            //'create_date',
            'price',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
