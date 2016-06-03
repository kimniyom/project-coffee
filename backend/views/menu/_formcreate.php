<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Type;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\helpers\Url;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\Menu */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'เพิ่มเมนู';
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<hr/>
<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-3 col-lg-3">
            <label>ประเภท</label>
            <select id="type" class="form-control">
                <option value="">== เลือกประเภท ==</option>
                <?php foreach ($type as $rs): ?>
                    <option value="<?php echo $rs['id'] ?>"><?php echo $rs['typename'] ?></option>
                <?php endforeach; ?>
            </select>
            <?php
            /*
              $form->field($model, 'type')->dropdownList(
              ArrayHelper::map(Type::find()->where(['upper' => null])->all(), 'id', 'typename'), [
              'id' => 'ddl-type',
              'prompt' => 'เลือกประเภท'
              ]);
             * 
             */
            ?>
        </div>
        <div class="col-md-9 col-lg-9">
            <label>เมนูอาหาร</label>
            <input type="text" id="menu" class="form-control" placeholder="เมนูอาหาร ..."/>
            <?php /* $form->field($model, 'menu')->textInput(['maxlength' => true]) */ ?>

        </div>
    </div>
    <div class="row">
        <div class="col-md-1 col-lg-1">
            <center>
                <label>Options</label><br/>
                <input type="checkbox" name="options" id="options" value="0" class="check" onclick="Checked()"/>
                <input type="hidden" id="_options"/>
            </center>
        </div>
        <div class="col-md-2 col-lg-2">
            <label>ราคา</label>
            <input type="number" class="form-control" id="price" value="0"/> 
        </div>
        <div class="col-md-2 col-lg-2">
            <div class="form-group">
                <button type="button" class="btn btn-success btn-block"
                        style=" margin-top: 25px;"
                        onclick="save()">บันทึกข้อมูล</button>
                        <?php
                        /*
                          Html::submitButton($model->isNewRecord ?
                          'Create' : 'Update', [
                          'class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block',
                          'style' => 'margin-top:25px;'
                          ]
                          )
                         * 
                         */
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
            $("#_options").val(1);
            $("#price").val('');
            $("#price").attr('disabled', 'disabled');
        } else {
            $("#_options").val(0);
            $("#price").val('');
            $("#price").removeAttr('disabled');
        }
    }
    
    function save(){
        var url =  "<?php echo Url::to(['menu/save'])?>";
        var type = $("#type").val();
        var menu = $("#menu").val();
        var _options = $("#_options").val();
        var price = $("#price").val();
        var datas = {
            type: type,
            menu: menu,
            options: _options,
            price: price
        };
        
        if(type == ""){
            $("#type").focus();
            return false;
        }
        
        if(menu == ""){
            $("#menu").focus();
            return false;
        }
        
        if(_options == 0){
            if(price == "" || price == "0"){
                $("#price").focus();
                return false;
            }
        }
        
        $.post(url,datas,function(response){
            var data = jQuery.parseJSON(response);
            if(data.options == 1){
                window.location="<?php echo Url::to(['menu/options'])?>" + '/&id=' + data.id;
            } else {
                window.location="<?php echo Url::to(['menu/formcreate'])?>";
            }
        });
    }
</script>
