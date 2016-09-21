<?php

use common\models\System;

$system = new System();
?>
<center>
    <?php if (!empty($product)) { ?>
    <?php foreach ($product as $p): ?>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <button type="button" class="btn btn-default btn-block" style=" margin-bottom: 5px;"
                        onclick="Save('<?php echo $p['id'] ?>')">
                    <img src="<?php echo $system->GetimagesProduct($p['images']) ?>" style=" max-height: 50px;"><br/>
                    <p id="mmenu"><?php echo $p['menu'] ?></p>
                </button>
            </div>
        <?php endforeach; ?>
    <?php } else { ?>
        !... ยังไม่มีรายการสินค้า
<?php } ?>
</center>