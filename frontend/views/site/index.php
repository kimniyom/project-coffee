<?php

use yii\helpers\Url;
use app\models\Type;
use app\models\Menu;
use common\models\System;

$system = new System();
$menu = new Menu();
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
</style>

<!--
    ###### Link #####
-->
<input type="hidden" id="orderID" value="<?php echo $order_id ?>" />

<input type="hidden" id="Saveorderlist" value="<?php echo Url::to(['orderlist/save']) ?>"/>
<input type="hidden" id="Deleteorderlist" value="<?php echo Url::to(['orderlist/deleteorderlist']) ?>"/>
<input type="hidden" id="Loadorderlist" value="<?php echo Url::to(['orderlist/load']) ?>"/>
<input type="hidden" id="calculator" value="<?php echo Url::to(['site/calculator']) ?>"/>

<div class="row">
    <div class="col-md-8 col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">Menu</div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <?php
                $i = 0;
                $typeproduct = Type::find()->all();
                foreach ($typeproduct as $t):
                    $i++;
                    if ($i == 1) {
                        $hclass = "active";
                    } else {
                        $hclass = "";
                    }
                    ?>
                    <li role="presentation" class="<?php echo $hclass ?>"><a href="#<?php echo $i; ?>" aria-controls="<?php echo $i; ?>" role="tab" data-toggle="tab"><?php echo $t['typename'] ?></a></li>
                <?php endforeach; ?>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content well" style=" border-radius: 0px; border-top: none; border: none; background: none; box-shadow: none;">
                <?php
                $a = 0;
                foreach ($typeproduct as $t2):
                    $a++;
                    if ($a == 1) {
                        $class = "active";
                    } else {
                        $class = "";
                    }
                    $product = $menu->Getmenu($t2['id']);
                    ?>
                    <div role="tabpanel" class="tab-pane <?php echo $class ?>" id="<?php echo $a ?>">
                        <center>
                            <?php foreach ($product as $p): ?>
                                <button type="button" class="btn btn-default" style=" margin-bottom: 5px;"
                                        onclick="Save('<?php echo $p['id'] ?>')">
                                    <img src="<?php echo $system->GetimagesProduct($p['images']) ?>" style=" max-height: 50px;"><br/>
                                    <?php echo $p['menu'] ?>
                                </button>
                            <?php endforeach; ?>
                        </center>
                    </div>
                <?php endforeach; ?>
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

        <div class="panel panel-danger">
            <div class="panel-heading">Calculator</div>
            <div class="panel-body">
                <div class="well well-sm">
                    รหัสรายการ <?php echo $order_id ?>โต๊ะที่ <?php echo $tables ?> วันนที่ขาย
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Tel.</div>
                        <input type="text" class="form-control" id="tel" placeholder="เบอร์โทรศัพท์ ...">
                        <div class="input-group-addon btn"><i class="fa fa-check"></i> ตรวจสอบ</div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">ส่วนลด</div>
                        <input type="text" class="form-control" id="discount" placeholder="ส่วนลด" value="0">
                        <div class="input-group-addon">บาท</div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">ราคารวม</div>
                        <input type="text" class="form-control" id="total" placeholder="ราคารวม">
                        <div class="input-group-addon">บาท</div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button type="button" class="btn btn-default">สั่ง</button>
                <button type="button" class="btn btn-default">เก็บเงิน</button>
                <button type="button" class="btn btn-default">พิมพ์ใบเสร็จ</button>
            </div>
        </div>
    </div>
</div>





