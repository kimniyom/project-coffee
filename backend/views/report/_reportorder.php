<?php

use app\models\Options;
use dektrium\user\models\Profile;

$Options = new Options();
$Profile = new Profile();
?>
<?php if (!empty($datas)) { ?>
    <table class=" table table-striped" id="reportall">
        <thead>
            <tr>
                <th>#</th>
                <th>รหัสการขาย</th>
                <th style=" text-align: center;">เลขโต๊ะ</th>
                <th style=" text-align: right;">ราคา</th>
                <th style="text-align: center;">วันที่</th>
                <th>ลูกค้า</th>
                <th>พนักงานขาย</th>
                <th style="text-align: center;">รายละเอียด</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sum = 0;
            $i = 0;
            foreach ($datas as $rs): $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $rs['order_id'] ?></td>
                    <td style=" text-align: center;"><?php echo $rs['tables'] ?></td>
                    <td style=" text-align: right;"><?php echo number_format($rs['total'], 2) ?></td>
                    <td style="text-align: center;"><?php echo $rs['create_date'] ?></td>
                    <td><?php echo $rs['customer']?></td>
                    <td>
                        <?php
                        if (!empty($rs['user_id']) || $rs['user_id'] != "0") {
                            echo $Profile->findOne(["user_id" => $rs['user_id']])['name'];
                        } else {
                            echo "Admin";
                        }
                        ?>
                    </td>
                    <td style=" text-align: center;"><button type="button" class="btn btn-default btn-xs" onclick="Detailorder('<?php echo $rs['order_id']?>')"><i class="fa fa-eye"></i> รายละเอียด</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php } else { ?>
    <center>... ยังไม่มีรายการขาย ...</center>
<?php } ?>

<script type="text/javascript">
    $(document).ready(function () {
        $("#reportall").DataTable();
    });
</script>