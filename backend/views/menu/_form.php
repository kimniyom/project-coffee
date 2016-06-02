<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Type;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<hr/>
<div class="menu-form">

<?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-3 col-lg-3">
            <?=
            $form->field($model, 'type')->dropdownList(
                    ArrayHelper::map(Type::find()->all(), 'id', 'typename'), [
                'id' => 'ddl-type',
                'prompt' => 'เลือกประเภท'
            ]);
            ?>
        </div>
        <div class="col-md-7 col-lg-7">
<?= $form->field($model, 'menu')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2 col-lg-2">
            <div class="form-group">
                <?=
                Html::submitButton($model->isNewRecord ?
                                'Create' : 'Update', [
                    'class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block',
                    'style' => 'margin-top:25px;'
                        ]
                )
                ?>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>

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
                                $link = Url::to(['menu/view','id' => $model->id]);
                                return "<a href='".$link."'><button type='button' class='btn btn-default btn-sm'>ส่วนผสม</button></a>";
                            },
                            'format' => 'raw'
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => 'Actions',
                            'headerOptions' => ['style' => 'text-align:center;'], // not max-width
                            'contentOptions' => ['style' => 'text-align:center;'], // not max-width
                        ],
                    ],
                ]);
                ?>
    </div>

</div>
