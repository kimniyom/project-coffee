<?php

use yii\helpers\Url;
?>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Options</th>
            <th>Price</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($options as $rs): $i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $rs['optionsname'] ?></td>
                <td><?php echo $rs['price'] ?></td>
                <td style=" text-align: right;">
                    <button class="btn btn-danger btn-sm" onclick="Deleteoptions('<?php echo $rs['id'] ?>')"><i class="fa fa-remove"></i></button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">
    function Deleteoptions(id) {
        var url = "<?php echo Url::to(['options/deleteoptions']) ?>";
        var orderID = $("#orderID").val();
        var menu = $("#menu_id").val();
        var data = {id: id};
        $.post(url, data, function (success) {
            Loadoptions(orderID, menu);
        });
    }
</script>