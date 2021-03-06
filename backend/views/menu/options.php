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

/* @var $this yii\web\View */
/* @var $model app\models\Menu */

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
                <div class="col-md-3 col-lg-4">
                    <input type="text" value="<?php echo "Menu : " . $model->menu; ?>" class="form-control" readonly="readonly" id="bold-text"/>
                </div>
                <div class="col-md-3 col-lg-4">
                    <?php $type = Type::find()->where(['id' => $model->type])->one()['typename'] ?>
                    <input type="text" value="<?php echo "ประเภท : " . $type; ?>" class="form-control" readonly="readonly" id="bold-text"/>
                </div>
                <div class="col-md-3 col-lg-4">
                    <input type="text" value="<?php echo "วันที่บันทึก : " . $model->create_date; ?>" class="form-control" readonly="readonly" id="bold-text"/>
                </div>
            </div>
        </div>
    </div>

</div>

<!--
    Form 
-->

<div class="box">
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-7 col-lg-7">
                <label>Options</label>
                <input type="text" class="form-control" id="options" placeholder="Options ..."/>
            </div>
            <div class="col-md-3 col-lg-3">
                <label>ราคา</label>
                <input type="number" class="form-control" id="price" placeholder="ตัวเลข ..."/>
            </div>
            <div class="col-md-2 col-lg-2">
                <button type="button" class="btn btn-success btn-block"
                        style=" margin-top: 25px;"
                        onclick="save()"><i class="fa fa-plus"></i> เพิ่ม</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <p>ex. เย็น,ร้อน,ปั่น</p>
            </div>
        </div>
        <hr/>
        <div id="result"></div>
    </div>
</div>
<!--
 Views
-->



<!-- Script -->
<?php
$this->registerJs('
            loaddata();
            ');
?>
<script type="text/javascript">

    function save() {
        var url = "<?php echo Url::to(['options/save']) ?>";
        var options = $("#options").val();
        var price = $("#price").val();
        var menu = "<?php echo $model->id ?>";
        var data = {options: options, price: price, menu: menu};
        if (options == '') {
            $("#options").focus();
            return false;
        }

        if (price == '') {
            $("#price").focus();
            return false;
        }

        $.post(url, data, function (success) {
            loaddata();
            resetform();
        });
    }


    function loaddata() {
        var url = "<?php echo Url::to(['options/loaddata']) ?>";
        var menu = "<?php echo $model->id ?>";
        var data = {menu: menu};
        $.post(url, data, function (result) {
            $("#result").html(result);
        });
    }

    function resetform() {
        $("#options").val('');
        $("#price").val('');
    }
</script>
