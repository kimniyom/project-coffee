<?php

use yii\helpers\Url;
?>
<div class="row">
    <?php
    foreach ($tables as $table):
        ?>
        <div class="col-sm-3 col-md-2">
            <div class="thumbnail">
                <img src="<?php echo Url::to('@web/web/images/table-icon.png') ?>" alt="..." style=" max-width: 100px;">
                <div class="caption" style=" text-align: center;">
                    <h3>โต๊ะที่ <?php echo $table['tables'] ?></h3>
                    <?php if ($table['active'] == '0') { ?>
                    <h4 style="color: green;">ว่าง</h4>
                        <a href="javascript:Openorders('<?php echo $table['tables'] ?>')" 
                           class="btn btn-success btn-block btn-lg" role="button">เลือก</a>
                       <?php } else { ?>
                        <h4 style="color: red;">ไม่ว่าง</h4>
                        <a href="javascript:Openorders('<?php echo $table['tables'] ?>')" 
                           class="btn btn-warning btn-block btn-lg" role="button"><i class="fa fa-plus"></i> สั่งของเพิ่ม</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script type="text/javascript">
    function Openorders(tables) {
        var url = "<?php echo Url::to(['orders/openorders']) ?>";
        var data = {tables: tables};
        $.post(url, data, function (response) {
            var datas = jQuery.parseJSON(response);
            var orderID = datas.orderID;
            window.location = "<?php echo Url::to(['site/tables']) ?>" + '&tables=' + tables + '&order=' + orderID;
        });
    }
</script>
