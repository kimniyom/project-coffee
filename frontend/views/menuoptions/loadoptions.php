<div class="row">
    <?php foreach ($options as $rs): ?>
        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3"
             onclick="AddOptions('<?php echo $rs['id'] ?>')"
             style="margin-top: 5px;">
            <button class="btn btn-info btn-block" style="text-align:center;">
                <b><?php echo $rs['options'] ?></b><br/>
                ราคา <?php echo $rs['price'] ?> .-
            </button>
        </div>
    <?php endforeach; ?>
</div>

<!--
        #########################
        ## ShowDataOptionsList ##
        #########################
-->

<div id="showdataoptions"></div>

