<?php

use yii\helpers\Url;
?>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Options</th>
            <th style="text-align: center;">ส่วนผสม</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($options as $rs): $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $rs['typename'] ?></td>
                <td style="text-align: center;">
                    <a href="<?php echo Url::to(['menu/view', 'id' => $rs['id']]) ?>">
                        <button type="button" class="btn btn-default btn-sm">
                            ส่วนผสม
                        </button></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
