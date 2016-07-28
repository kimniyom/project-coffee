<?php

use yii\helpers\Url;
?>
<div class="row">
    <center>
        <?php
        foreach ($tables as $table):
            ?>
            <div class="col-sm-3 col-md-2">
                <div class="thumbnail btn btn-default" onclick="Openorders('<?php echo $table['tables'] ?>')">
                    <img src="<?php echo Url::to('@web/web/images/table-icon.png') ?>" alt="..." style=" max-width: 100px;">
                    <div class="caption" style=" text-align: center;">
                        <h3>โต๊ะที่ <?php echo $table['tables'] ?></h3>
                        <?php if ($table['active'] == '0') { ?>
                            <h4 style="color: green;">ว่าง</h4>
                        <?php } else { ?>
                            <h4 style="color: red;">ไม่ว่าง</h4>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </center>
</div>

<?php
$this->registerJs(' $(document).ready(function () {
        var defaults = "' . $typeBuy . '";
            if(defaults == "0"){
                Openorders(defaults);
            }
    });')
?>
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
