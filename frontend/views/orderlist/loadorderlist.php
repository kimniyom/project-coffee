<?php

use yii\helpers\Url;
?>      
<div class="panel panel-default">
    <div class="panel-heading">
        รายการขาย
    </div>
    <div class="panel-body">
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>รายการ1</th>
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
                foreach ($orderlist as $rs):
                    $sum = $sum + $rs['price'];
                    $j++;
                    ?>
                    <tr>
                        <td style="width: 10%;">
                            <img src="<?php echo Url::to('@web/web/images/5.jpg') ?>" alt="..." class="img-responsive">
                        </td>
                        <td><?php echo $rs['menuname'] ?></td>
                        <td style=" text-align: center;">1</td>
                        <td style="text-align:right;"><?php echo $rs['price'] ?></td>
                        <td style="text-align: right;">
                            <button type="button" class="btn btn-danger btn-xs"
                                    onclick="Deleteorderlist('<?php echo $rs['id'] ?>')">
                                <i class="fa fa-trash-o"></i></button>
                        </td>
                    </tr>
<?php endforeach; ?>
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