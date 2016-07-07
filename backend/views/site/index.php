<?php

use yii\helpers\Url;
?>

<style type="text/css">
    #con_menu button{
        margin-bottom: 20px;
    }
</style>

<div style=" text-align: center;">
    <br/><br/>
    <h1><i class="fa fa-gear"></i> BackOffice DemoCoffee</h1><br/><br/>
</div>

<div class="row" style=" text-align: center;" id="con_menu">
    <div class="col-lg-2"></div>
    <div class="col-sm-6 col-md-6 col-lg-2">
        <a href="<?php echo Url::to(['stock/index'])?>">
        <button type="button" class="btn btn-default btn-block">
            <img src="<?php echo Url::to('@web/images/shop-icon.png') ?>"/><br/>
            Stock สินค้า
        </button></a>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-2">
        <a href="<?php echo Url::to(['menu/index'])?>">
        <button type="button" class="btn btn-default btn-block">
            <img src="<?php echo Url::to('@web/images/food-icon.png') ?>"/><br/>
            เมนูอาหารและเครื่องดื่ม
        </button></a>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-2">
        <a href="<?php echo Url::to(['report/reportall'])?>">
        <button type="button" class="btn btn-default btn-block">
            <img src="<?php echo Url::to('@web/images/seo-icon.png') ?>"/><br/>
            รายงาน
        </button></a>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-2">
        <a href="<?php echo Url::to(['employee/index'])?>">
        <button type="button" class="btn btn-default btn-block">
            <img src="<?php echo Url::to('@web/images/users-icon.png') ?>"/><br/>
            พนักงาน
        </button></a>
    </div>
    <div class="col-lg-2"></div>
</div>