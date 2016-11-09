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
$this->title = 'รายงานการขาย';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-warning">
    <div class="panel-heading">ตัวกรองรายงาน</div>
    <div class="panel-body">
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
    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-md-3 col-lg-3">
                <button type="button" class="btn btn-warning btn-flat"
                        onclick="Getreport()"><i class="fa fa-eye"></i> ดูรายงาน</button>
            </div>
        </div>
    </div>
</div>

<div class="orderlist-index">
    <h2 class="text-warning"><i class="fa fa-file-text-o"></i> แสดงรายการขาย</h2>
    <div class="box box-default">
        <div class="box-body" id="showreport">

        </div>
    </div>
</div>

<!--
    ###### POPUP Detail Order ######
-->
<div class="modal fade" tabindex="-1" role="dialog" id="popupdetailorder">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="result_detailorder"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php
$this->registerJs('
        $(document).ready(function () {
        Getreport();
    });');
?>

<script type="text/javascript">
    function Getreport() {
        var tables = $("#tables").val();
        var date_start = $("#date_start").val();
        var date_end = $("#date_end").val();
        var url = "<?php echo Url::to(['report/getreportorder']) ?>";

        /*
         if (type == null || menu == null) {
         sweetAlert("ข้อผิดพลาด...", "กรุณาตรวจสอบความครบถ้วนของเงื่อนไข (ประเภทหรือเมนู)..!", "error");
         return false;
         }
         */
        var data = {
            date_start: date_start,
            date_end: date_end,
            tables: tables
        };

        $.post(url, data, function (result) {
            $("#showreport").html(result);
        });
    }

    function Detailorder(orderId) {
        $("#popupdetailorder").modal();
        var url = "<?php echo Url::to(['report/detailorder']) ?>";
        var data = {
            orderId: orderId
        };

        $.post(url, data, function (result) {
            $("#result_detailorder").html(result);
        });
    }
</script>
