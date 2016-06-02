<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Type;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create Menu', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php // echo $this->render('_search', ['model' => $searchModel]);    ?>
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo $this->title; ?></div>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'id',
                [
                    'class' => 'kartik\grid\ExpandRowColumn',
                    'expandAllTitle' => 'Expand all',
                    'collapseTitle' => 'Collapse all',
                    'expandIcon' => '<span class="glyphicon glyphicon-expand"></span>',
                    'value' => function ($model) {
                        $types = Type::find()->where(['options' => '1', 'id' => $model->type])->one();
                        if ($types['options'] == '1') {
                            return GridView::ROW_COLLAPSED;
                        } else {
                            return "-";
                        }
                    },
                            'detail' => function ($model) {
                        $data['options'] = Type::find()->where(['upper' => $model->type])->all();
                        return Yii::$app->controller->renderPartial('//type/options', $data);
                    },
                            'detailOptions' => [
                                'class' => 'kv-state-enable',
                            ],
                        ],
                        [
                            'attribute' => 'menu',
                            'header' => 'เมนู',
                        ],
                        [
                            'attribute' => 'type',
                            'header' => 'ประเภท',
                            'value' => function($model) {
                                $type = Type::find()->where(['id' => $model->type])->one();
                                return $type->typename;
                            },
                                    'filterType' => GridView::FILTER_SELECT2,
                                    'filter' => ArrayHelper::map(Type::find()->orderBy('id')->asArray()->all(), 'id', 'typename'),
                                    'filterWidgetOptions' => [
                                        'pluginOptions' => ['allowClear' => true],
                                    ],
                                    'filterInputOptions' => ['placeholder' => 'ประเภท'],
                                    'format' => 'raw',
                                ],
                                [
                                    'attribute' => 'create_date',
                                    'header' => 'วันที่นำเข้า',
                                    'hAlign' => 'center',
                                ],
                                [
                                    //'attribute' => 'create_date',
                                    'header' => 'ส่วนประกอบ',
                                    'hAlign' => 'center',
                                    'value' => function($model) {
                                        $Type2 = Type::find()->where(['options' => '1','id' => $model->type])->one();
                                        if ($Type2['options'] == '1') {
                                            return "";
                                        } else {
                                            $link = Url::to(['menu/view', 'id' => $model->id]);
                                            return "<a href='" . $link . "'><button type='button' class='btn btn-default btn-sm'>ส่วนผสม</button></a>";
                                        }
                                    },
                                            'format' => 'raw'
                                        ],
                                        [
                                            'class' => 'yii\grid\ActionColumn',
                                            'header' => 'Actions',
                                            'headerOptions' => ['style' => 'text-align:center;'], // not max-width
                                            'contentOptions' => ['style' => 'text-align:center;'], // not max-wisdth
                                        ],
                                    ],
                                ]);
                                ?>
    </div>
</div>
