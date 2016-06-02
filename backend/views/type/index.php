<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ประเภท';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-index">
    <p>
        <?= Html::a('เพิ่มประเภท', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><?= Html::encode($this->title) ?></h4>
        </div>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <div class="panel-body">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'id',
                    [
                        'attribute' => 'typename',
                        'format' => 'raw',
                        'value' => function($model){
                            if($model['options'] == '1'){
                                $link = Url::to(['type/view','id' => $model->id]);
                                return "<a href='".$link."' >".$model['typename']."</a>";
                            } else {
                                return $model['typename'];
                            }
                        }
                    ],
                    //'typename',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions' => ['style' => 'text-align:center;'],
                        'template' => '{update}{delete}'
                        ],
                ],
            ]);
            ?>
        </div>
    </div>
</div>
