<?php

use app\models\Menu;
use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Options;
use kartik\select2\Select2;
use app\models\Type;
use yii\helpers\ArrayHelper;
use app\models\Menu as menus;
use app\models\Tables;
use app\models\Orders;
use kartik\date\DatePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderlistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$Options = new Options();
$this->title = 'การขายทั้งหมด';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-4 col-lg-4">
        <label>รหัสการขาย</label>
        <?php
        // Multiple select without model
        echo Select2::widget([
            'name' => 'orders',
            'value' => '',
            'data' => ArrayHelper::map(Orders::find()->all(), 'order_id', 'order_id'),
            'theme' => Select2::THEME_BOOTSTRAP, // this is the default if theme is not set
            'options' => [
                'id' => 'orders',
                'multiple' => true,
                'placeholder' => 'ทั้งหมด ...'
            ]
        ]);
        ?>
    </div>
</div>

<div class="row">
    <div class="col-md-4 col-lg-4">
        <?php
        // usage without model
        echo '<label>เริ่มต้น</label>';
        echo DatePicker::widget([
            'name' => 'check_issue_date',
            'value' => date('Y-m-d'),
            'language' => 'th',
            // 'value' => date('d-M-Y', strtotime('+2 days')),
            'options' => [
                'placeholder' => 'Select issue date ...',
                'id' => 'date_start',
            ],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true
            ]
        ]);
        ?>
    </div>
    <div class="col-md-4 col-lg-4">
        <?php
        // usage without model
        echo '<label>สิ้นสุด</label>';
        echo DatePicker::widget([
            'name' => 'check_issue_date',
            'value' => date('Y-m-d'),
            'language' => 'th',
            // 'value' => date('d-M-Y', strtotime('+2 days')),
            'options' => [
                'placeholder' => 'Select issue date ...',
                'id' => 'date_end',
            ],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true
            ]
        ]);
        ?>
    </div>
</div>

<div class="row">
    <div class="col-md-9 col-lg-9">
        <label>ประเภท</label>
        <?php
        // Multiple select without model
        echo Select2::widget([
            'name' => 'type',
            'value' => '',
            'data' => ArrayHelper::map(Type::find()->all(), 'id', 'typename'),
            'theme' => Select2::THEME_BOOTSTRAP, // this is the default if theme is not set
            'options' => [
                'id' => 'type',
                'multiple' => true,
                'placeholder' => 'ทั้งหมด ...'
            ]
        ]);
        ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <label>เมนู</label>
        <?php
        // Multiple select without model
        echo Select2::widget([
            'name' => 'menu',
            'value' => '',
            'data' => ArrayHelper::map(menus::find()->all(), 'id', 'menu'),
            'theme' => Select2::THEME_BOOTSTRAP, // this is the default if theme is not set
            'options' => [
                'id' => 'menu',
                'multiple' => true,
                'placeholder' => 'ทั้งหมด ...'
            ]
        ]);
        ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <label>โต๊ะ</label>
        <?php
        // Multiple select without model
        echo Select2::widget([
            'name' => 'tables',
            'value' => '',
            'data' => ArrayHelper::map(Tables::find()->all(), 'tables', 'tables'),
            'theme' => Select2::THEME_BOOTSTRAP, // this is the default if theme is not set
            'options' => [
                'id' => 'tables',
                'multiple' => true,
                'placeholder' => 'ทั้งหมด ...'
            ]
        ]);
        ?>
    </div>
</div>

<div class="row">
    <div class="col-md-3 col-lg-3">
        <br/>
        <button type="button" class="btn btn-default btn-flat"
                onclick="Getreport()"><i class="fa fa-eye"></i> ดูรายงาน</button>
    </div>
</div>

<div class="orderlist-index">
    <h2><i class="fa fa-file-text-o"></i> <?= Html::encode($this->title) ?></h2>
    <div class="box box-default">
        <div class="box-body" id="showreport">

        </div>
    </div>
</div>

<?php
$this->registerJs('
        $(document).ready(function () {
        Getreport();
    });');
?>

<script type="text/javascript">
    function Getreport() {
        var type = $("#type").val();
        var menu = $("#menu").val();
        var tables = $("#tables").val();
        var date_start = $("#date_start").val();
        var date_end = $("#date_end").val();
        var orders = $("#orders").val();
        var url = "<?php echo Url::to(['report/getreport']) ?>";

        /*
         if (type == null || menu == null) {
         sweetAlert("ข้อผิดพลาด...", "กรุณาตรวจสอบความครบถ้วนของเงื่อนไข (ประเภทหรือเมนู)..!", "error");
         return false;
         }
         */
        var data = {
            type: type,
            menu: menu,
            date_start: date_start,
            date_end: date_end,
            tables: tables,
            orders: orders
        };

        $.post(url, data, function (result) {
            $("#showreport").html(result);
        });
    }
</script>
