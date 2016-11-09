<?php

use common\models\System;
use app\models\Menu;
use app\models\Unit;
$system = new System();
$Menu = new Menu();
$Unit = new Unit();
?>
<center>
    <?php if (!empty($product)) { ?>
    <?php foreach ($product as $p): 
        $Total = $Menu->CheckCub($p['id']);
        ?>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <?php if(isset($Total)) { ?>
                <button type="button" class="btn btn-default btn-block" style=" margin-bottom: 5px;"
                        onclick="Save('<?php echo $p['id'] ?>','<?php echo $p['menu'] ?>')">
                    <img src="<?php echo $system->GetimagesProduct($p['images']) ?>" style=" max-height: 50px;"><br/>
                    <p id="mmenu"><?php echo $p['menu'] ?></p>
                    <p style=" color: #ff0000;">คงเหลือ <?php echo "<label class='label label-success'>".$Total."</label> ".$Unit->findOne(['id' => $p['unit']])['unit'] ?></p>
                </button>
                <?php } else { ?>
                <button type="button" class="btn btn-danger btn-block disabled" style=" margin-bottom: 5px;">
                    <img src="<?php echo $system->GetimagesProduct($p['images']) ?>" style=" max-height: 50px;"><br/>
                    <p id="mmenu"><?php echo $p['menu'] ?></p>
                    <p>หมด</p>
                </button>
                <?php } ?>
            </div>
        <?php endforeach; ?>
    <?php } else { ?>
        !... ยังไม่มีรายการสินค้า
<?php } ?>
</center>