<?php

use yii\helpers\Url;
?>
<div class="row">
    <center>
        <?php
        foreach ($tables as $table):
            ?>
            <div class="col-sm-4 col-md-4 col-lg-2" style=" margin-bottom: 20px;">
                <div class="thumbnail btn btn-default btn-flat" onclick="Openorders('<?php echo $table['tables'] ?>')" style=" margin-bottom: 0px;">
                    <img src="<?php echo Url::to('@web/web/images/table-icon.png') ?>" alt="..." style=" max-width: 100px;">
                    <div class="caption" style=" text-align: center;">
                        <h3>โต๊ะที่ <?php echo $table['tables'] ?></h3>
                        <?php if ($table['tables'] != "0") { ?>
                            <?php if ($table['active'] == '0') { ?>
                                <h4 style="color: green;">ว่าง</h4>
                            <?php } else { ?>
                                <h4 style="color: red;">ไม่ว่าง</h4>
                            <?php } ?>
                        <?php } else { ?>
                                <h4 style="color: blue;">Default</h4>
                        <?php } ?>
                    </div>
                </div>
                <button type="button" class="btn btn-default btn-block btn-flat" onclick="Getdeatil('<?php echo $table['comment'] ?>')">Detail</button>
            </div>
        <?php endforeach; ?>
    </center>
</div>

<!-- 
    ####################
    ### Popup Detail ###
    ####################
-->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" id="popupdetail">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Deatil</h4>
            </div>
            <div class="modal-body" id="deatilfull" style=" text-align: center; color: #ff0000; font-weight: bold;">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php
$this->registerJs(' $(document).ready(function () {
        $("#mainpage").addClass("sidebar-collapse");
        $(".sidebar-toggle").hide();
        $("#menuleft").hide();
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

    function Getdeatil(detail) {
        $("#popupdetail").modal();
        $("#deatilfull").html(detail);
    }
</script>
