<?php 
    use yii\helpers\Url;
?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#optionstable").dataTable();
    });

    function settext(id, options, price) {
        $("#formeditoptions").modal();
        $("#optionID").val(id);
        $("#_options").val(options);
        $("#_price").val(price);
    }

    function edit() {
        var url = "<?php echo Url::to(['options/edit']) ?>";
        var options = $("#_options").val();
        var price = $("#_price").val();
        var id = $("#optionID").val();
        var data = {options: options, price: price, id: id};
        if (options == '') {
            $("#_options").focus();
            return false;
        }

        if (price == '') {
            $("#_price").focus();
            return false;
        }

        $.post(url, data, function (success) {
            loaddata();
            $("#formeditoptions").modal('hide');
        });
    }
    
    function deleteoptions(id){
        var r = confirm("คุณแน่ใจหรือไม่ ...?");
        if(r == true){
            var url = "<?php echo Url::to(['options/deleteoptions'])?>";
            var data = {id: id};
            $.post(url,data,function(success){
                loaddata();
            });
        }
    }
</script>

<table class="table table-striped table-bordered" id="optionstable">
    <thead>
        <tr>
            <th>#</th>
            <th>Options</th>
            <th>ราคา</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($options as $rs): $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $rs['options'] ?></td>
                <td><?php echo $rs['price'] ?></td>
                <td style=" text-align: center;">
                    <a href="javascript:settext('<?php echo $rs['id'] ?>','<?php echo $rs['options'] ?>',<?php echo $rs['price'] ?>)"><i class="fa fa-pencil"></i></a>
                    <a href="javascript:deleteoptions('<?php echo $rs['id']?>');"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="modal fade" tabindex="-1" role="dialog" id="formeditoptions">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">แก้ไข</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-9 col-lg-9">
                        <input type="hidden" id="optionID"/>
                        <label>Options</label>
                        <input type="text" class="form-control" id="_options" placeholder="Options ..."/>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <label>ราคา</label>
                        <input type="number" class="form-control" id="_price" placeholder="ตัวเลข ..."/>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="edit()">Save</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->






