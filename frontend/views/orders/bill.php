<?php

use yii\helpers\Url;
use common\models\System;
use app\models\Options;
use common\models\Setting;
use frontend\assets\AdminLteAsset;
use frontend\assets\AppAsset;
use dektrium\user\models\Profile;
AppAsset::register($this);
AdminLteAsset::register($this);

$Options = new Options();
$system = new System();
$setting = new Setting();

$config = new System();
$urlBE = Url::to('@web/uploads', TRUE);
$logo = $config->LinktoBackend($urlBE . '/' . $setting->DetailShop('logo'));

$Profile = new Profile();
?>    

<style type="text/css" media="print,screen">
        #line{
            border-top: #cccccc dashed 1px;
            padding-top: 10px;
            margin-top: 10px;
        }
        #line2{
            border-top: #cccccc dashed 1px;
            padding-top: 10px;
            margin-top: 10px;
        }
        #bo{
            height: 20px;
        }
        
</style>

<center>
    <img src="<?php echo $logo ?>" class="img-responsive" style="width: 38px;"/><br/>
    <?php echo $setting->DetailShop('shopname') ?>
    <br/> <br/>
    <div style=" font-size: 12px;">
        Date: <?php echo date('Y-m-d H:i:s') ?><br/>
        Order: (<?php echo $order['order_id'] ?>) Tables: (<?php echo $order['tables'] ?>)<br/>
        พนังานขาย : <?php if(!empty($order['user_id']) || $order['user_id'] != '0') echo $Profile->findOne(["user_id" => $order['user_id']])['name']; else echo "Admin";?>
    </div>
</center>
<br/>
<table style=" width: 100%; font-size: 14px; color: #666666;" cellpadding="0" border="0" cellspacing='0' class="table table-bordered">
    <thead>
        <tr>
            <th></th>
            <th>รายการ</th>
            <th style=" text-align: right;">ราคา</th>
        </tr>
        
    </thead>
    <tbody>
        <?php
        $sum = 0;
        $SumAll = 0;
        $sumProduct = 0;
        $j = 0;
        foreach ($orderlist as $rs):

            $j++;
            //Get Options 
            $dataOptions = $Options->Getdata($rs['order'], $rs['menu'], $rs['id']);
            ?>
            <tr>
                <td valign="top"><?php echo $j; ?></td>
                <td>
                    <?php echo $rs['menuname'] ?>
                    <?php
                    $OptionsPrice = 0;
                    foreach ($dataOptions as $op):
                        echo "<br/>+ " . $op['optionsname'] . "(" . $op['price'] . ")";
                        $OptionsPrice = $OptionsPrice + $op['price'];
                    endforeach;
                    $sum = $sum + ($rs['price'] + $OptionsPrice);
                    ?>
                </td>
                <td style="text-align:right;" valign="top"><?php echo number_format($rs['price'] + $OptionsPrice, 2) ?></td>
            </tr>
        <?php endforeach; ?>
            <tr>
                <td colspan="3" id="bo"></td>
            </tr>
    </tbody>
    
    <tfoot>
        <tr>
            <td colspan="2" style="text-align:right; font-weight: bold;" id="line"><b>รวม</b></td>
            <td style="text-align:right; font-weight: bold;" id="line"><?php echo number_format($sum, 2); ?></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:right; font-weight: bold;"><b>ส่วนลด</b></td>
            <td style="text-align:right; font-weight: bold;"><?php echo number_format($order['distcount'], 2); ?></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:right; font-weight: bold;"><b>รวมสุทธิ</b></td>
            <td style="text-align:right; font-weight: bold;"><?php echo number_format($order['total'], 2); ?></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:right; font-weight: bold;"><b>รับเงิน</b></td>
            <td style="text-align:right; font-weight: bold;"><?php echo number_format($order['income'], 2); ?></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:right; font-weight: bold;"><b>เงินทอน</b></td>
            <td style="text-align:right; font-weight: bold;"><?php echo number_format($order['change'], 2); ?></td>
        </tr>
    </tfoot>
</table>

<div style="border-bottom: #cccccc dashed 1px; width: 100%; margin-top: 10px; margin-bottom: 10px;"></div>
<div style=" font-size: 12px; text-align: center;">
    <span>ลูกค้า <?php echo $order['customer'] ?> โทร. <?php echo $order['tel'] ?></span><br/>
    <span style="color: #cccccc;">**** Password Wifi **** </span><br/>
    <span style="color: #cccccc;">****</span> 
    <span style=" color: #999999;"><?php echo $setting->DetailShop('wifi') ?></span>
    <span style="color: #cccccc;"> ****</span>
</div>
<br/><br/>

<div style=" font-size: 12px; text-align: center;">
    <span style="color: #cccccc;">**** Thanks **** </span><br/>
</div>
