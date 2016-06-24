<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Type;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\web\UrlManager;

/* @var $this yii\web\View */
/* @var $model app\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<hr/>
<div class="menu-form">
    <?php
    $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data']
    ]);
    ?>
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
        <div class="col-md-9 col-lg-9">
            <?= $form->field($model, 'menu')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 col-lg-2">
            <?=
            $form->field($model, 'price')->textInput([
                'maxlength' => true,
                'type' => 'number'
            ])
            ?>
        </div>
        <div class="col-md-2 col-lg-2">
            <p style="margin-top:30px;"></p>
            <?php
            echo $form->field($model, 'mix')->checkBox(['label' => 'ส่วนผสม', 'uncheck' => 0, 'checked' => 1]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 col-lg-2">
            <div class="well text-center">
                <?= Html::img($model->getPhotoViewer(), ['style' => 'width:100px;', 'class' => 'img-rounded']); ?>
            </div>
            <?= $form->field($model, 'images')->fileInput() ?>
        </div>
    </div>

    <div class="row">
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
                                $link = Url::to(['menu/view', 'id' => $model->id]);
                                return "<a href='" . $link . "'><button type='button' class='btn btn-default btn-sm'>ส่วนผสม</button></a>";
                            },
                                    'format' => 'raw'
                                ],
                                [
                                    'header' => 'รูปภาพ',
                                    'options' => ['style' => 'width:150px;'],
                                    'format' => 'raw',
                                    'attribute' => 'images',
                                    'value' => function($model) {
                                return Html::tag('div', '', [
                                            'style' => 'width:100px;height:45px;
                          border-top: 10px solid rgba(255, 255, 255, .46);
                          background-image:url(' . $model->photoViewer . ');
                          background-size: cover;
                          background-position:center center;
                          background-repeat:no-repeat;
                          ']);
                            }
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

<script type="text/javascript">
    function Checked() {
        if ($('#options').is(':checked')) {
            $("#price").val('');
            $("#price").attr('disabled', 'disabled');
        } else {
            $("#price").val('');
            $("#price").removeAttr('disabled');
        }
    }
</script>
