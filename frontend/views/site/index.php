<?php

use yii\helpers\Url;
use app\models\Category;
use app\models\Type;
use app\models\Menu;

$menu = new Menu();
$images = array("1.jpeg", "2.jpg", "3.jpg", "4.JPG");
$names = array("ลาเต้", "คาปูชิโน่", "เอสเปรสโซ่", "มอคค่า");
$price = array("35", "40", "40", "35");
$count = count($names);
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
<div class="row">
    <div>
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
        <div class="tab-content well" style=" border-radius: 0px; border-top: none; background: none; box-shadow: none;">
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
                        <button type="button" class="btn btn-default" style=" margin-bottom: 5px;">
                                <img src="<?php echo Url::to('@web/web/images/coffee-type.png') ?>"><br/>
                                <?php echo $p['menu'] ?>
                            </button>
                        <?php endforeach; ?>
                    </center>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-3 col-lg-3">
        <div class="list-group">
            <a href="#" class="list-group-item active">
                ประเภทอาหาร/เครื่องดื่ม
            </a>
            <?php
            $type = Type::find()->all();
            foreach ($type as $types):
                ?>
                <a href="#" class="list-group-item" onclick="GetProduct()">
                    <img src="<?php echo Url::to('@web/web/images/coffee-type.png') ?>">
                    <?php echo $types['typename'] ?>
                </a>
            <?php endforeach; ?>
        </div>
        <div class="well" style=" text-align: center;">
            <h3 style="margin: 5px;">โต๊ะที่ <?php echo $tables; ?></h3>
            <center>
                <img src="<?php echo Url::to('@web/web/images/table-icon.png') ?>" alt="..." class="img-responsive" style=" max-width: 128px;">
            </center>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                รายการขาย
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>รายการ</th>
                            <th style="text-align: center;">จำนวน</th>
                            <th style=" text-align: right;">ราคา</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sum = 0;
                        $sumProduct = 0;
                        $j = 0;
                        for ($i = 0; $i <= (count($images) - 1); $i++):
                            $sum = $sum + $price[$i];
                            $j++;
                            ?>
                            <tr>
                                <td style="width: 10%;"><img src="<?php echo Url::to('@web/web/images/' . $images[$i]) ?>" alt="..." class="img-responsive"></td>
                                <td><?php echo $names[$i] ?></td>
                                <td style=" text-align: center;">1</td>
                                <td style="text-align:right;"><?php echo $price[$i] ?></td>
                                <td style="text-align: right;">
                                    <button type="button" class="btn btn-danger btn-xs">
                                        <i class="fa fa-trash-o"></i></button>
                                </td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" style="text-align:center; background:#eeeeee;"><b>รวม</b></td>
                            <td style=" background: #666666; text-align: center; font-weight: bold; color: #ffffff;"><?php echo $j; ?></td>
                            <td style="text-align:right; background:#000000; color: #ffffff; font-weight: bold;"><?php echo $sum; ?></td>
                            <td style=" background: #eeeeee;"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-3 col-lg-4">
        <div class="well">
            <div class="well" style="background:green; color:#ffffff;font-size:20px;">
                จำนวน
                <div class="pull-right"><input type="number" class="form-control" value="10" style="text-align: right;"/></div>
            </div>
            <div class="well" style="background:orange; color:#ffffff;font-size:20px;">
                ราคารวม 
                <div class="pull-right"><input type="number" class="form-control" value="0" style="text-align: right;"/></div>
            </div>
            <div class="well" style="background:blue; color:#ffffff;font-size:20px;">
                เงินรับ 
                <div class="pull-right"><input type="number" class="form-control" value="0" style="text-align: right;"/></div>
            </div>
            <div class="well" style="background:red; color:#ffffff;font-size:20px;">
                เงินทอน 
                <div class="pull-right"><input type="number" class="form-control" value="0" style="text-align: right;"/></div>
            </div>
        </div>
        <div class="well" style=" background: #333333;">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <a href="<?php echo Url::to(['site/index']) ?>">
                        <button type="button" class="btn btn-default btn-lg btn-block">
                            <i class="fa fa-print fa-2x text-success"></i><br/>
                            ยืนยันรายการ
                        </button></a>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <button type="button" class="btn btn-danger btn-lg btn-block"
                            onclick="CancelOrder('')">
                        <i class="fa fa-remove fa-2x"></i><br/>
                        ยกเลิกการขาย
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Get Product -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="popup-product">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Coffee</h4>
            </div>
            <div class="modal-body">
                รายการอาหาร / เครื่องดื่ม

                <!--
                <div class="row">
                -->
                <div>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
                                <img src="<?php echo Url::to('@web/web/images/Coffee-Cup-icon.png') ?>" alt="...">
                                ร้อน
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
                                <img src="<?php echo Url::to('@web/web/images/Coffee-icon.png') ?>" alt="...">
                                เย็น
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">
                                <img src="<?php echo Url::to('@web/web/images/irish-coffee-icon.png') ?>" alt="...">
                                ปั่น
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content" style=" padding-top: 10px;">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <div class="row">
                                <?php for ($i = 0; $i <= ($count - 1); $i++): ?>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="thumbnail">
                                            <img src="<?php echo Url::to('@web/web/images/' . $images[$i]) ?>" alt="...">
                                            <div class="caption">
                                                <h3><?php echo $names[$i] ?></h3>
                                                <h4>ราคา <span style=" color: #ff3300;"><?php echo $price[$i] ?> </span>บาท</h4>
                                                <form class="form-inline">
                                                    <div class="form-group">
                                                        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">จำนวน</div>
                                                            <input type="number" class="form-control" value="1"/>
                                                        </div>
                                                    </div>
                                                </form><br/>
                                                <p><a href="javascript:Closepopup()" class="btn btn-success btn-block btn-lg" role="button">ตกลง</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="profile">...</div>
                        <div role="tabpanel" class="tab-pane" id="messages">...</div>
                    </div>

                </div>
            </div>
            <!--
            </div>
            -->
            <!--
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            -->
        </div>
    </div>
</div>

<script type="text/javascript">
    function GetProduct() {
        $("#popup-product").modal();
    }

    function Closepopup() {
        $("#popup-product").modal("hide");
    }


    function CancelOrder() {
        var r = confirm("คุณแน่ใจหรือไม่ ... ?");
        if (r == true) {
            window.location = "<?php echo Url::to(['site/index']) ?>";
        }
    }
</script>
