<?php

use yii\helpers\Url;
use common\models\System;
use app\models\Options;
use common\models\Setting;

$Options = new Options();
$system = new System();
$setting = new Setting();

$config = new System();
$urlBE = Url::to('@web/uploads', TRUE);
$logo = $config->LinktoBackend($urlBE . '/' . $setting->DetailShop('logo'));
?>    
<center>
    <img src="<?php echo $logo ?>" class="img-responsive" style="width: 38px;"/><br/>
    <?php echo $setting->DetailShop('shopname') ?>
    <br/> <br/>
    <div style=" font-size: 12px;">
        Date: <?php echo date('Y-m-d H:i:s') ?><br/>
        Order: (<?php echo $order['order_id'] ?>) Tables: (<?php echo $order['tables'] ?>)
    </div>
</center>
<br/>
<table style=" width: 100%; font-size: 14px; color: #666666;">
    <thead>
        <tr style=" border-top: solid #000 1px;">
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

    </tbody>
    <tfoot>
        <tr style=" border-top: solid 1px #000;">
            <td colspan="2" style="text-align:center; font-weight: bold;"><b>รวม</b></td>
            <td style="text-align:right; font-weight: bold;"><?php echo number_format($sum, 2); ?></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center; font-weight: bold;"><b>ส่วนลด</b></td>
            <td style="text-align:right; font-weight: bold;"><?php echo number_format($order['distcount'], 2); ?></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center; font-weight: bold;"><b>รวมสุทธิ</b></td>
            <td style="text-align:right; font-weight: bold;"><?php echo number_format($order['total'], 2); ?></td>
        </tr>
    </tfoot>
</table>

<div style="border-bottom: #cccccc dashed 1px; width: 100%; margin-top: 10px; margin-bottom: 10px;"></div>
<div style=" font-size: 12px; text-align: center;">

    <span style="color: #cccccc;">**** Password Wifi **** </span><br/>
    <span style="color: #cccccc;">****</span> 
    <span style=" color: #999999;"><?php echo $setting->DetailShop('wifi') ?></span>
    <span style="color: #cccccc;"> ****</span>

</div>
