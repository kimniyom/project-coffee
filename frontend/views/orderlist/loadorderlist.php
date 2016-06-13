<?php

use yii\helpers\Url;
use common\models\System;
use app\models\Options;

$Options = new Options();
$system = new System();
?>      
<div class="panel panel-success">
    <div class="panel-heading">
        รายการขาย
    </div>
    <div id="table">
        <table class="table table-striped">
            <thead>
                <tr>
                    <!--
                    <th></th>
                    -->
                    <th>รายการ</th>
                    <th style=" text-align: center;">ราคา</th>
                    <th>Options</th>
                    <th style=" text-align: center;" class="Toptions">เพิ่ม Options</th>
                    <th style=" text-align: center;">ราคา</th>
                    <th style="text-align: right;">รวม</th>
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

                    //Get Options 
                    $dataOptions = $Options->Getdata($rs['order'], $rs['menu'], $rs['id']);
                    ?>
                    <tr>
                        <!--
                        <td style="width: 10%;">
                            <img src="<?//php echo $system->GetimagesProduct($rs['images']) ?>" alt="..." class="img-responsive img-circle" style=" max-height: 50px;">
                        </td>
                        -->
                        <td><?php echo $rs['menuname'] ?></td>
                        <td style="text-align:center;"><?php echo $rs['price'] ?></td>
                        <td>
                            <?php
                            $OptionsPrice = 0;
                            foreach ($dataOptions as $op):
                                echo "+ " . $op['optionsname'] . "(" . $op['price'] . ")<br/>";
                                $OptionsPrice = $OptionsPrice + $op['price'];
                            endforeach;
                            ?>
                        </td>
                        <td style=" text-align: center;" class="Toptions">
                            <button type="button" class="btn btn-success btn-sm"
                                    onclick="popupoptions('<?php echo $rs['menu'] ?>', '<?php echo $rs['id'] ?>')"><i class="fa fa-plus"></i> เพิ่ม</button>
                        </td>
                        <td style="text-align:center;"><?php echo $OptionsPrice ?></td>
                        <td style="text-align:right;"><?php echo $rs['price'] + $OptionsPrice ?></td>
                        <td style="text-align: right;">
                            <?php if ($rs['confirm'] == '0') { ?>
                                <button type="button" class="btn btn-danger btn-xs"
                                        onclick="Deleteorderlist('<?php echo $rs['id'] ?>')">
                                    <i class="fa fa-trash-o"></i></button>
                                <?php } ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var confirmorder = $("#confirmorder").val();
        if (confirmorder == 1) {
            $(".Toptions").hide();
        } else {
            $(".Toptions").show();
        }
    });
</script>

