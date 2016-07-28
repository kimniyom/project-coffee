<?php

use app\models\Options;

$Options = new Options();
?>
<?php if (!empty($datas)) { ?>
    <table class=" table table-striped" id="reportall">
        <thead>
            <tr>
                <th>#</th>
                <th>รหัสการขาย</th>
                <th>ประเภท</th>
                <th>รายการ</th>
                <th style=" text-align: center;">เลขโต๊ะ</th>
                <th style=" text-align: right;">ราคา</th>
                <th style="text-align: center;">วันที่</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sum = 0;
            $i = 0;
            $sumProduct = 0;
            foreach ($datas as $rs): $i++;
                $dataOptions = $Options->Getdata($rs['order'], $rs['menu'], $rs['id']);
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $rs['order'] ?></td>
                    <td><?php echo $rs['typename'] ?></td>
                    <td>
                        <?php echo $rs['menuname'] ?>
                        <?php
                        $OptionsPrice = 0;
                        foreach ($dataOptions as $op):
                            echo "<br/>+ " . $op['optionsname'] . "(" . $op['price'] . ")";
                            $OptionsPrice = $OptionsPrice + $op['price'];
                        endforeach;
                        $sumProduct = ($rs['price'] + $OptionsPrice);
                        $sum = $sum + $sumProduct;
                        ?>
                    </td>
                    <td style=" text-align: center;"><?php echo $rs['tables'] ?></td>
                    <td style=" text-align: right;"><?php echo number_format($sumProduct, 2) ?></td>
                    <td style="text-align: center;"><?php echo $rs['create_date'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" style=" text-align: center; font-weight: bold;">รวม</td>
                <td style=" text-align: right; font-weight: bold;"><?php echo number_format($sum, 2) ?></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
<?php } else { ?>
    <center>... ยังไม่มีรายการขาย ...</center>
<?php } ?>

<script type="text/javascript">
    $(document).ready(function () {
        $("#reportall").DataTable();
    });
</script>