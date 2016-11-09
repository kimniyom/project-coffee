<?php

use yii\helpers\Url;
use app\models\Type;
use app\models\Menu;
use common\models\System;

$system = new System();
$menu = new Menu();

$ActiveCat = \app\models\Type::find(['active' => '1', 'setactive' => '1'])->one();
$categoryActive = $ActiveCat['id'];
?>
<style type="text/css">
    .nav-tabs > li, .nav-pills > li {
        float:none;
        display:inline-block;
        *display:inline; /* ie7 fix */
        zoom:1; /* hasLayout ie7 trigger */
    }

    .nav-tabs, .nav-pills {
        text-align:center;
    }

    .activemenu{
        background: #FFFFFF;
    }

    .panel .panel-heading{
        background: #474754;
        color: #cccccc;
    }

    #btn-controls .btn{
        margin-bottom: 10px;
    }

    @media screen and (max-width: 1024px) {
        #Rcontrol{
            text-align: center;
        }
    }

    @media screen and (min-width: 1024px) {
        #Rcontrol{
            text-align: right;
        }
    }
    
    @media screen and (max-width: 480px) {
        #btn-control{
            display: none;
        }
    }
    

    @media screen and (max-width: 768px) {
        #btn-control{
            font-size: 12px;
        }
    }
    
    .panel{
        border: none;
    }
    
    .panel .panel-body{
        
    }
    
    .panel .panel-heading{
        border: none;
    }
</style>

<!--
    ###### Link #####
-->
<input type="hidden" id="orderID" value="<?php echo $order_id ?>" />
<input type="hidden" id="tables" value="<?php echo $tables ?>" />
<input type="hidden" id="confirmorder" value="<?php echo $model['confirm'] ?>" />

<input type="hidden" id="Saveorderlist" value="<?php echo Url::to(['orderlist/save']) ?>"/>
<input type="hidden" id="Deleteorderlist" value="<?php echo Url::to(['orderlist/deleteorderlist']) ?>"/>
<input type="hidden" id="Loadorderlist" value="<?php echo Url::to(['orderlist/load']) ?>"/>
<input type="hidden" id="calculator" value="<?php echo Url::to(['site/calculator']) ?>"/>
<input type="hidden" id="Urlcheckbill" value="<?php echo Url::to(['orders/checkbill']) ?>"/>
<input type="hidden" id="Urltel" value="<?php echo Url::to(['orders/addtel']) ?>"/>
<input type="hidden" id="Urlcustomer" value="<?php echo Url::to(['orders/addcustomer']) ?>"/>
<input type="hidden" id="Urlbill" value="<?php echo Url::to(['orders/bill']) ?>"/>
<input type="hidden" id="Urlendorder" value="<?php echo Url::to(['orders/endorder']) ?>"/>

<div class="well well-sm" style=" padding-bottom: 0px; background:#474754; border: none;">
    <div class="row">
        <div class="col-lg-6" style=" margin-bottom: 0px;">
            <div class="row" id="btn-controls">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <?php if ($model['flag'] == '0') { ?>
                    <button type="button" class="btn btn-primary btn-lg btn-block" onclick="send('<?php echo $order_id ?>')"><img src="<?php echo Url::to('@web/web/images/Status-mail-task-icon.png') ?>"/> <span id="btn-control">สั่ง</span></button>
                    <?php } else { ?>
                        <button type="button" class="btn btn-default btn-lg disabled btn-block"><img src="<?php echo Url::to('@web/web/images/Status-mail-task-icon.png') ?>"/> <span id="btn-control">สั่ง</span></button>
                    <?php } ?>
                </div>

                <?php
                if ($model['confirm'] == '0') {
                    ?>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <?php if ($model['flag'] == 1) { ?>
                            <button type="button" class="btn btn-success btn-lg btn-block"
                                    onclick="Check_bill()"><img src="<?php echo Url::to('@web/web/images/Cash-register-icon.png') ?>"/> <span id="btn-control">ชำระเงิน</span></button>
                                <?php } else { ?>
                        <button type="button" class="btn btn-default btn-lg disabled btn-block"><img src="<?php echo Url::to('@web/web/images/Cash-register-icon.png') ?>"/> <span id="btn-control">ชำระเงิน</span></button>
                        <?php } ?>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <button type="button" class="btn btn-default btn-lg disabled btn-block"><img src="<?php echo Url::to('@web/web/images/print-icon.png') ?>"/> <span id="btn-control">พิมพ์ใบเสร็จ</span></button>
                    </div>
                <?php } else { ?>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <button type="button" class="btn btn-default btn-lg disabled btn-block"><img src="<?php echo Url::to('@web/web/images/success-icon.png') ?>"/> <span id="btn-control">ชำระเงินแล้ว</span></button>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <button type="button" class="btn btn-warning btn-lg btn-block" onclick="Bill()"><img src="<?php echo Url::to('@web/web/images/print-icon.png') ?>"/> <span id="btn-control">พิมพ์ใบเสร็จ</span></button>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-lg-6" style="margin-bottom: 10px;" id="Rcontrol">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <?php
                    if ($model['confirm'] == '1') {
                        ?>
                        <button type="button" class="btn btn-primary btn-lg btn-block"
                                onclick="EndOrder()"><img src="<?php echo Url::to('@web/web/images/success-icon.png') ?>"/> <span id="btn-control">สิ้นสุดการขาย</span></button>
                            <?php } else { ?>
                    <button type="button" class="btn btn-default btn-lg disabled btn-block"><img src="<?php echo Url::to('@web/web/images/success-icon.png') ?>"/> <span id="btn-control">สิ้นสุดการขาย</span></button>
                    <?php } ?>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <button type="button" class="btn btn-danger btn-lg btn-block"
                            onclick="cancelorder('<?php echo $order_id ?>', '<?php echo $tables ?>')"><img src="<?php echo Url::to('@web/web/images/Status-dialog-error-icon.png') ?>"/> <span id="btn-control">ยกเลิก</span></button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8 col-lg-8">
        <div class="panel panel-default" id="menuproduct">
            <div class="panel-heading">
                <h4><i class="fa fa-coffee"></i> <font id="h_category"></font></h4>
                <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
            </div>
            <div class="panel-body" id="menubody">
                <div id="showItems"></div>
                <!-- Nav tabs
                <ul class="nav nav-tabs" role="tablist">
                <?php
                /*
                  $i = 0;
                  $typeproduct = Type::find()->all();
                  foreach ($typeproduct as $t):
                  $i++;
                  if ($i == 1) {
                  $hclass = "active";
                  } else {
                  $hclass = "";
                  }
                 * 
                 */
                ?>
                        <li role="presentation" class="<?//php echo $hclass ?>">
                            <a href="#<?//php echo $i; ?>" aria-controls="<?//php echo $i; ?>" role="tab" data-toggle="tab" id="htab"><?//php echo $t['typename'] ?></a>
                        </li>
                    <?//php endforeach; ?>
                </ul>

                <div class="row">
                    <div class="tab-content" 
                         style="border-radius: 0px; border-top: none; border: none; box-shadow: none; padding-top: 10px;">
                <?php
                /*
                  $a = 0;
                  foreach ($typeproduct as $t2):
                  $a++;
                  if ($a == 1) {
                  $class = "active";
                  } else {
                  $class = "";
                  }
                  $product = $menu->Getmenu($t2['id']);
                 * 
                 */
                ?>
                            <div role="tabpanel" class="tab-pane <?//php echo $class ?>" id="<?//php echo $a ?>">
                                <center>
                                    <?//php foreach ($product as $p): ?>
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                            <button type="button" class="btn btn-default btn-block" style=" margin-bottom: 5px;"
                                                    onclick="Save('<?//php echo $p['id'] ?>')">
                                                <img src="<?//php echo $system->GetimagesProduct($p['images']) ?>" style=" max-height: 50px;"><br/>
                                                <p id="mmenu"><?//php echo $p['menu'] ?></p>
                                            </button>
                                        </div>
                                    <?//php endforeach; ?>
                                </center>
                            </div>
                        <?//php endforeach; ?>
                    </div>
                </div>
                -->
            </div>
        </div>

        <!-- 
            ### รายการขาย ###
        -->
        <div id="orderlist"></div>
    </div>

    <div class="col-sm-12 col-md-4 col-lg-4">
        <!--
            ########################
            ### Views OrderLidt ####
            ########################
        -->
        <div id="boxcalculator">
            <div class="calculator">
                <div class="panel panel-default" id="calculator">
                    <div class="panel-heading">
                        <h4><i class="fa fa-calculator"></i> คำนวณค่าใช้จ่าย</h4>
                        <span class="pull-right clickable" id="resizesmall" title="ซ่อน"><i class="glyphicon glyphicon-chevron-up"></i></span>
                        <span class="pull-right hand" onclick="PopupCalcular()" id="resize" style=" margin-right: 25px;" title="ขยาย"><i class="glyphicon glyphicon-resize-full"></i></span>
                        <span class="pull-right hand" onclick="RePopupCalcular()" id="c_calculator" style=" display: none;" title="ปิด"><i class="glyphicon glyphicon-remove"></i></span>
                    </div>
                    <div class="panel-body">
                        <div class="well well-sm" id="headcalculator">
                            รหัสรายการ <?php echo $order_id ?>
                            โต๊ะที่ <?php echo $tables ?> 
                            วันที่ขาย <?php echo $system->Thaidate(date("Y-m-d")) ?>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">ราคารวม</div>
                                <input type="text" class="form-control" id="total" placeholder="ราคารวม" value="0" readonly="readonly">
                                <div class="input-group-addon">บาท</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">ส่วนลด</div>
                                <input type="text" class="form-control" id="discount" placeholder="ส่วนลด" value="0"
                                       onkeypress="return chkNumber(this.value)"
                                       onkeyup="Distcount(this.value)">
                                <div class="input-group-addon">บาท</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">รวมสุทธิ</div>
                                <input type="text" class="form-control" id="_total" placeholder="ราคารวม" readonly="readonly">
                                <div class="input-group-addon">บาท</div>
                            </div>
                        </div>
                        <?php if ($model['flag'] == '1') { ?>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">ชื่อลูกค้า</div>
                                    <input type="text" class="form-control" id="customer" placeholder="ชื่อลูกค้า ..." value="<?php echo $model['customer'] ?>">
                                    <div class="input-group-addon btn btn-default" id="btn-customer"
                                         onclick="AddCustomer()"><i class="fa fa-plus"></i> เพิ่ม</div>
                                </div>
                            </div>
                        
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">Tel.</div>
                                    <input type="text" class="form-control" id="tel" placeholder="เบอร์โทรศัพท์ ..."
                                           onkeypress="return chkNumber(this.value)" value="<?php echo $model['tel'] ?>">
                                    <div class="input-group-addon btn btn-default" id="btn-tel"
                                         onclick="AddTel()"><i class="fa fa-plus"></i> เพิ่ม</div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($model['flag'] == 1) { ?>
                            <hr/>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">รับเงิน</div>
                                    <input type="text" class="form-control" id="income" value="<?php echo $model['income'] ?>" placeholder="รับเงิน"
                                           onkeypress="return chkNumber(this.value)"
                                           onkeyup="Income(this.value)">
                                    <div class="input-group-addon">บาท</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">เงินทอน</div>
                                    <input type="text" class="form-control" id="change" value="<?php echo $model['change'] ?>" readonly="readonly">
                                    <div class="input-group-addon">บาท</div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="panel-footer" id="calculator-footer" style=" display: none;">
                        <?php if ($model['confirm'] == 0) { ?>
                            <button type="button" class="btn btn-success btn-lg btn-block"
                                    onclick="Check_bill()"><img src="<?php echo Url::to('@web/web/images/Cash-register-icon.png') ?>"/> ชำระเงิน</button>
                                <?php } else { ?>
                            <button type="button" class="btn btn-default btn-lg disabled btn-block"><img src="<?php echo Url::to('@web/web/images/Cash-register-icon.png') ?>"/> ชำระเงิน</button>
                        <?php } ?>
                    </div>

                </div>
            </div>


        </div>


    </div>
</div>

<!--
    ##############
    ###### Bill ######
    ##############
-->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" id="popupbill">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <!--
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            -->
            <div class="modal-body" id="bodybill">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary"
                        onclick="PrintElem('#bodybill')">Print</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!--
    ##############
    #### Options ####
    ##############
-->
<div class="modal fade" tabindex="-1" role="dialog" id="popupoptions">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <!--
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                -->
                <h4 class="modal-title">รายการเพิ่มเติม</h4>
            </div>

            <input type="hidden" id="menu_id" class="form-control"/>
            <input type="hidden" id="orderlist_id" />
            <div class="modal-body" id="bodyoptions">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- 
    #########################
    ### Popup Detail Full ###
    #########################
-->
<div class="modal fade" tabindex="-1" role="dialog" id="popupcalculator" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style=" background: none;">

            <div class="modal-body">
                <div id="calculatorfull"></div>
                <div id="boxlistorderfull"></div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php
$this->registerjs("$(document).on('click', '.panel-heading span.clickable', function (e) {
        var t = $(this);
        if (!t.hasClass('panel-collapsed')) {
            t.parents('.panel').find('.panel-body').slideUp();
            t.addClass('panel-collapsed');
            t.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
        } else {
            t.parents('.panel').find('.panel-body').slideDown();
            t.removeClass('panel-collapsed');
            t.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
        }
    });
 Activemenu('" . $categoryActive . "', '" . $ActiveCat['typename'] . "');
 Getitems('" . $categoryActive . "');  
    
 
");
?>
<script type="text/javascript">

    function send(orderId) {
        var total = $("#_total").val();
        var url = "<?php echo Url::to(['orders/buy']) ?>";
        var data = {orderid: orderId};
        if (total <= 0) {
            //alert("ยังไม่มีรายการสินค้า ...");
            swal("แจ้งเตือน!", "ยังไม่มีรายการสินค้า ...!", "warning");
            return false;
        }
        $.post(url, data, function (success) {
            window.location.reload();
        });
    }

    function Getitems(id, hmenu) {
        $("#h_category").html(hmenu);
        var url = "<?php echo Url::to(['site/getitems']) ?>";
        var data = {catid: id};
        var loading = '<center><i class="fa fa-spinner fa-spin fa-3x fa-fw text-danger"></i><br/>Loading...<center>';
        $("#showItems").html(loading);
        $.post(url, data, function (datas) {
            $("#showItems").html(datas);
        });
    }

    function Activemenu(id, hmenu) {
        $(".ac").removeClass('activemenu');
        $("#" + id).addClass('activemenu');
        Getitems(id, hmenu);
    }

    function PopupCalcular() {
        $("#calculatorfull").html($(".calculator"));
        $("#boxlistorderfull").html($(".boxlistorder"));
        $("#calculator-footer").show();
        $(".ht").hide();
        $("#c_calculator").show();
        $("#resize").hide();
        $("#resizesmall").hide();
        $("#popupcalculator").modal();
    }

    function RePopupCalcular() {
        $("#boxcalculator").html($(".calculator"));
        $("#boxlistorder").html($(".boxlistorder"));
        $("#calculator-footer").hide();
        $(".ht").show();
        $("#c_calculator").hide();
        $("#resize").show();
        $("#resizesmall").show();
        $("#popupcalculator").modal('hide');
    }

    
</script>





