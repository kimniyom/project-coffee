<?php

use app\models\Options;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Type;
use common\models\System;
$Config = new System();
$Type = Type::find()->all();
$Options = new Options();
$this->title = 'ตัดสต๊อก';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="orderlist-index">
    <h2><i class="fa fa-cut text-red"></i> <?= Html::encode($this->title) ?></h2>

    <div class="row">
        <div class="col-md-3 col-lg-3">
            <div class="box box-default">
                <div class="box-header">ประเภทเครื่องดื่ม / อาหาร</div>
                <div class="box-body">
                    <button type='button' class='btn btn-default btn-block' onclick="javascript:window.location.reload();">ทั้งหมด</button>
                    <?php 
                        foreach($Type as $t):
                            echo "<button type='button' class='btn btn-default btn-block' onclick=\"gettype('".$t['id']."')\">".$t['typename']."</button>";
                        endforeach;
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-lg-9">
            <div class="box box-default">
                <div class="box-body" id="showdata">
                    <?php if (!empty($datas)) { ?>
                        <table class=" table table-striped" id="cutstock">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>รหัสการขาย</th>
                                    <th>ประเภท</th>
                                    <th>รายการ</th>
                                    <th style=" text-align: center;">เลขโต๊ะ</th>
                                    <th style=" text-align: right;">ราคา</th>
                                    <th style="text-align: center;">วันที่</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sum = 0;
                                $i = 0;
                                $sumProduct = 0;
                                foreach ($datas as $rs): $i++;
                                    $dataOptions = $Options->Getdata($rs['order'], $rs['menu'], $rs['id']);
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $rs['order'] ?></td>
                                        <td><?php echo $rs['typename'] ?></td>
                                        <td>
                                            <?php echo $rs['menuname'] ?>
                                            <?php
                                            $OptionsPrice = 0;
                                            foreach ($dataOptions as $op):
                                                echo "<br/>+ " . $op['optionsname'] . "(" . $op['price'] . ")";
                                                $OptionsPrice = $OptionsPrice + $op['price'];
                                            endforeach;
                                            $sumProduct = ($rs['price'] + $OptionsPrice);
                                            $sum = $sum + $sumProduct;
                                            ?>
                                        </td>
                                        <td style=" text-align: center;"><?php echo $rs['tables'] ?></td>
                                        <td style=" text-align: right;"><?php echo number_format($sumProduct, 2) ?></td>
                                        <td style="text-align: center;"><?php echo $Config->Thaidate($rs['create_date']) ?></td>
                                        <td style=" text-align: center;">
                                            <button type="button" class="btn btn-default btn-xs"
                                                    onclick="cutstock('<?php echo $rs['order'] ?>', '<?php echo $rs['menu'] ?>')"><i class="fa fa-cut text-red"></i> ตัดสต๊อก</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>

                        </table>
                    <?php } else { ?>
                        <center>... ยังไม่มีรายการขาย ...</center>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!--
    ###### Modal #####
-->
<div class="modal" id="alertcheckorder">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Alert !</h4>
            </div>
            <div class="modal-body">
                <p id="showalert"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<?php
$this->registerJs(
        '
    $(document).ready(function () {
        $("#cutstock").DataTable();
    });
        ');
?>

<script type="text/javascript">
    function cutstock(orderid, menuid) {
        var url = "<?php echo Url::to(['cutstock/checkstock']) ?>";
        var data = {orderid: orderid, menuid: menuid};
        $.post(url, data, function (success) {
         
            if (success === '0') {
                
                //alert("ไม่สามารถตัดสต๊อกรายการนี้ได้ เนื่องจากวัถุดิบไม่เพียงพอ ....!");
                var url2 = "<?php echo Url::to(['cutstock/listorder']) ?>";
                var data2 = {menuid: menuid};
                $.post(url2, data2, function (datas) {
                    $("#alertcheckorder").modal();
                    $("#showalert").html("<center><b class='text-red'>ไม่สามารถตัดสต๊อกรายการนี้ได้ เนื่องจากวัถุดิบไม่เพียงพอ ....!</b></center><br/>" + datas);
                });
                return false;
            } else {
                //alert("ตัดสต๊อกสำเร็จ ...");
                swal("", "ตัดสต๊อกสำเร็จ", "success");
                window.location.reload();
            }

        });
    }
    
    function gettype(type){
        var url = "<?php echo Url::to(['cutstock/stockintype'])?>";
        var data = {type: type};
        $.post(url,data,function(datas){
            $("#showdata").html(datas);
        });
    }
</script>
