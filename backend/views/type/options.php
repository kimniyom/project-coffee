<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Options</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0; foreach ($options as $rs): $i++;?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $rs['typename']?></td>
            <td>
                <button type="button" class="btn btn-default btn-sm">
                    <i class="fa fa-trash-o"></i>
                </button>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
