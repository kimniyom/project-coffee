<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use app\models\Type;
use app\models\Category;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use kartik\widgets\Select2;
use app\models\Stockproduct;
use app\models\Unit;
use kartik\widgets\ActiveForm;
use common\models\System;

/* @var $this yii\web\View */
/* @var $model app\models\Menu */

$config = new System();

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-view">
    <div class="panel panel-default">
        <div class="panel-heading">
            <b>ข้อมูลรายการเมนู</b>
            <?= Html::a('แก้ไขเมนู', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-xs']) ?>
            <?=
            Html::a('ลบเมนู', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger btn-xs',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-2 col-lg-2" style=" text-align: center;">

                    <?= Html::img($model->getPhotoViewer(), ['style' => 'width:100px;', 'class' => 'img-rounded']); ?>

                </div>
                <div class="col-md-10 col-lg-10 text-left">
                    <input type="text" value="<?php echo "Menu : " . $model->menu; ?>" class="form-control" readonly="readonly" id="bold-text"/>
                    <?php $type = Type::find()->where(['id' => $model->type])->one()['typename'] ?>
                    <input type="text" value="<?php echo "ประเภท : " . $type; ?>" class="form-control" readonly="readonly" id="bold-text"/>
                    <input type="text" value="<?php echo "ราคา : " . $model->price . " บาท"; ?>" class="form-control" readonly="readonly" id="bold-text"/>
                    <input type="text" value="<?php echo "วันที่บันทึก : " . $config->Thaidate($model->create_date); ?>" class="form-control" readonly="readonly" id="bold-text"/>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mix-form">
    <div class="well">
        <div class="comment-form">
            <?php
            $form = ActiveForm::begin([
                        'enableAjaxValidation' => true,
                        'validateOnSubmit' => true,
                        'options' => ['id' => 'formsave']
                            //'action' => ['mix/create'],
            ]);
            ?>
            <?=
            $form->field($mixModel, 'menu')->hiddenInput([
                //'type' => 'hidden',
                'value' => $model->id,
            ])->label(false);
            ?>
            <div class="row">
                <div class="col-md-3 col-lg-3">
                    <label>หมวด</label>
                    <?php
                    /*
                      $form->field($mixModel, 'category')->dropdownList(
                      ArrayHelper::map(Category::find()->all(), 'id', 'cat_name'), [
                      'id' => 'category',
                      'prompt' => 'เลือกหมวด'
                      ]);
                     * 
                     */
                    // Multiple select without model
                    echo Select2::widget([
                        'id' => 'category',
                        'name' => 'category',
                        'value' => '',
                        'data' => ArrayHelper::map(Category::find()->all(), 'id', 'cat_name'),
                        'options' => [
                            'multiple' => false,
                            'placeholder' => 'Select states ...'
                        ]
                    ]);
                    ?>
                </div>
                <div class="col-md-4 col-lg-4">
                    <?php
                    echo $form->field($mixModel, 'product_stock_id')->widget(DepDrop::classname(), [
                        'options' => ['id' => 'product'],
                        'data' => [],
                        'type' => DepDrop::TYPE_SELECT2,
                        'pluginOptions' => [
                            'depends' => ['category'],
                            'placeholder' => 'เลือกสินค้า...',
                            'url' => Url::to(['/mix/getproduct'])
                        ]
                    ]);
                    ?>
                </div>

                <div class="col-md-3 col-lg-3">

                    <?=
                    $form->field($mixModel, 'number')->textInput([
                        'type' => 'number',
                    ])
                    ?>
                </div>
                <div class="col-md-2 col-lg-2">
                    <?php
                    echo Html::submitButton($mixModel->isNewRecord ?
                                    '<i class="fa fa-plus"></i> เพิ่ม' : 'Update', [
                        'class' => $mixModel->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block',
                        'style' => 'margin-top:25px;',
                    ])
                    ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        รายการส่วนผสม
        <?php if ($countLock == 0) { ?>
            <button type="button" class="btn btn-danger btn-xs pull-right"
                    onclick="lock('Y')"><i class="fa fa-lock"></i> Lock</button>
                <?php } else { ?>
            <button type="button" class="btn btn-info btn-xs pull-right"
                    onclick="lock('N')"><i class="fa fa-unlock"></i> UnLock</button>
        <?php } ?>
    </div>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'pjax' => true, // pjax is set to always true for this demo
        'pjaxSettings' => [
            'neverTimeout' => true,
            'options' => [
                'id' => 'gview',
            ]
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            //'menu',
            [
                //'attribute' => 'product_stock_id',
                'format' => 'raw',
                'label' => 'ประเภท',
                'value' => function($model) {
                    $pt = Stockproduct::find()->where(['id' => $model->product_stock_id])->one();
                    $t = Category::find()->where(['id' => $pt->category])->one();
                    return $t->cat_name;
                }
                    ],
                    [
                        //'attribute' => 'product_stock_id',
                        'format' => 'raw',
                        'label' => 'สินค้า',
                        'value' => function($model) {
                            $p = Stockproduct::find()->where(['id' => $model->product_stock_id])->one();
                            return $p->productname;
                        }
                            ],
                            [
                                //'attribute' => 'product_stock_id',
                                'format' => 'raw',
                                'label' => 'จำนวน',
                                'value' => function($model) {
                                    return $model->number;
                                },
                                'hAlign' => 'center'
                            ],
                            [
                                //'attribute' => 'product_stock_id',
                                'format' => 'raw',
                                'label' => 'หน่วยนับ',
                                'hAlign' => 'center',
                                'value' => function($model) {
                                    $pu = Stockproduct::find()->where(['id' => $model->product_stock_id])->one();
                                    $unit = Unit::find()->where(['id' => $pu->unit])->one();
                                    return $unit->unit;
                                }
                                    ],
                                    //'create_date',
                                    [
                                        'format' => 'raw',
                                        'hAlign' => 'center',
                                        'value' => function($model) {
                                            if ($model->lock == 'N') {
                                                return "<a href=\"Javascript:Delete('" . $model->id . "')\"><i class='fa fa-trash'></i> delete</a>";
                                            } else {
                                                return "delete";
                                            }
                                        }
                                    ],
                                /*
                                  [
                                  'class' => 'yii\grid\ActionColumn',
                                  'contentOptions' => ['style' => 'text-align:center;'],
                                  'template' => '{delete}',
                                  ],
                                 * 
                                 */
                                ],
                            ]);
                            ?>
                        </div>

                        <script type="text/javascript">
                            function Delete(id) {
                                var r = confirm("คุณแน่ใจหรือไม่ ... ?");
                                var url = "<?php echo Url::to(['mix/delmix']) ?>";
                                var data = {id: id};
                                if (r == true) {
                                    $.post(url, data, function (datas) {
                                        Reload();
                                    });
                                }
                            }

                            function Reload() {
                                $.pjax.reload({container: '#gview'});
                            }

                        </script>


                        <script type="text/javascript">
                            function lock(status) {
                                var url = "<?php echo Url::to(['mix/lock']) ?>";
                                var menu = "<?php echo $model->id ?>";
                                var data = {status: status, menu: menu};
                                $.post(url, data, function () {
                                    window.location.reload();
                                });
                            }
                        </script>

                        <?php
                        $url = Url::to(['mix/create']);
                        $this->registerJs("
		  $('body').on('beforeSubmit', 'form#formsave', function () {
			$.ajax({
                                url: '$url',
                                type: 'POST',
                                data: $('.comment-form form').serializeArray(),
                                success: function (data) {
                                      Reload();
                                }
			});
                       return false;
		  });
		");
                        ?>
