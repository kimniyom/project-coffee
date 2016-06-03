<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>รายการ</th>
            <th style="text-align: right;">ราคา</th>
            <th style="text-align: center;">ส่วนผสม</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0; foreach($options as $rs): $i++;?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $rs['options']?></td>
            <td style="text-align: right;"><?php echo $rs['price']?></td>
            <td style="text-align: center;">
                <button type="button" class="btn btn-default btn-sm">ส่วนผสม</button>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>

