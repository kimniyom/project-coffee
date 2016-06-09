<?php

use yii\helpers\Url;
use common\models\System;

$system = new System();
?>    
<div style=" font-size: 12px;">
    Date: <?php echo date('Y-m-d H:i:s') ?><br/>
    Order: (<?php echo $order['order_id'] ?>) Tables: (<?php echo $order['tables'] ?>)
</div><br/>
<table style=" width: 100%;">
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
        $sumProduct = 0;
        $j = 0;
        foreach ($orderlist as $rs):
            $sum = $sum + $rs['price'];
            $j++;
            ?>
            <tr>
                <td><?php echo $j; ?></td>
                <td><?php echo $rs['menuname'] ?></td>
                <td style="text-align:right;"><?php echo number_format($rs['price'],2) ?></td>
            </tr>
        <?php endforeach; ?>

    </tbody>
    <tfoot>
        <tr style=" border-top: solid 1px #000;">
            <td colspan="2" style="text-align:center; font-weight: bold;"><b>รวม</b></td>
            <td style="text-align:right; font-weight: bold;"><?php echo number_format($sum,2); ?></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center; font-weight: bold;"><b>ส่วนลด</b></td>
            <td style="text-align:right; font-weight: bold;"><?php echo number_format($order['distcount'],2); ?></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center; font-weight: bold;"><b>รวมสุทธิ</b></td>
            <td style="text-align:right; font-weight: bold;"><?php echo number_format($order['total'],2); ?></td>
        </tr>
    </tfoot>
</table>
