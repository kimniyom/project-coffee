<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use backend\assets\AdminLteAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
AdminLteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="skin-black-light">
        <?php $this->beginBody() ?>

        <div class="wrapper">
            <?php
            /*
              NavBar::begin([
              'brandLabel' => 'ระบบจัดการร้านกาแฟ',
              'brandUrl' => Yii::$app->homeUrl,
              'options' => [
              'class' => 'navbar-inverse navbar-fixed-top',
              ],
              ]);
              $menuItems = [
              ['label' => 'Home', 'url' => ['/site/index']],
              ['label' => 'เมนูอาหาร', 'url' => ['/menu/index']],
              ['label' => 'Stock', 'url' => ['/stock/index']],
              [
              'label' => 'Setting',
              'items' => [
              ['label' => 'หมวดสินค้า', 'url' => ['/category/index']],
              ['label' => 'หน่วยนับ', 'url' => ['/unit/index']],
              ['label' => 'สินค้า', 'url' => ['/stockproduct/index']],
              ['label' => 'ประเภทรายการอาหาร', 'url' => ['/type/index']],
              ],
              ],
              ];
              if (Yii::$app->user->isGuest) {
              $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
              } else {
              $menuItems[] = '<li>'
              . Html::beginForm(['/site/logout'], 'post')
              . Html::submitButton(
              'Logout (' . Yii::$app->user->identity->username . ')',
              ['class' => 'btn btn-link']
              )
              . Html::endForm()
              . '</li>';
              }
              echo Nav::widget([
              'options' => ['class' => 'navbar-nav navbar-right'],
              'items' => $menuItems,
              ]);
              NavBar::end();
             */
            ?>

            <header class="main-header">
                <!-- Logo -->
                <a href="../../index2.html" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>C</b>offee</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Coffee</b>BackOffice</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo Url::to('@web/themes/AdminLTE/dist/img/user2-160x160.jpg') ?>" class="user-image" alt="User Image">
                                    <span class="hidden-xs">
                                        <?php
                                        if (!Yii::$app->user->isGuest) {
                                            echo Yii::$app->user->identity->username;
                                        }
                                        ?>
                                    </span>
                                </a>
                            </li>
                            <?php
                            if (!Yii::$app->user->isGuest) {
                                echo '<li>'
                                . Html::beginForm(['/site/logout'], 'post')
                                . Html::submitButton(
                                        '<i class="fa fa-power-off"></i> Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link']
                                )
                                . Html::endForm()
                                . '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </nav>
            </header>

            <!--
                ##### Side Bar #####
            -->
            <!-- =============================================== -->

            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo Url::to('@web/themes/AdminLTE/dist/img/user2-160x160.jpg') ?>" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>
                                <?php
                                if (!Yii::$app->user->isGuest) {
                                    echo Yii::$app->user->identity->username;
                                }
                                ?>
                            </p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <?php if (!\Yii::$app->user->isGuest) { ?>
                        <ul class="sidebar-menu">
                            <li class="header">MAIN NAVIGATION</li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-gear"></i> <span>ตั้งค่า</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="<?php echo Url::to(['category/index']); ?>"><i class="fa fa-circle-o"></i> หมวดสินค้า</a></li>
                                    <li><a href="<?php echo Url::to(['unit/index']); ?>"><i class="fa fa-circle-o"></i> หน่วยนับ</a></li>
                                    <li><a href="<?php echo Url::to(['stockproduct/index']); ?>"><i class="fa fa-circle-o"></i> สินค้า</a></li>
                                    <li><a href="<?php echo Url::to(['type/index']); ?>"><i class="fa fa-circle-o"></i> ประเภทรายการสินค้า</a></li>
                                    <li><a href="<?php echo Url::to(['tables/index']); ?>"><i class="fa fa-circle-o"></i> โต๊อาหาร</a></li>
                                    <li><a href="<?php echo Url::to(['menuoptions/index']); ?>"><i class="fa fa-circle-o"></i> Options เพิ่มเติม</a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo Url::to(['stock/index']) ?>"><i class="fa fa-cube"></i>Stock</a></li>
                            <li><a href="<?php echo Url::to(['menu/index']) ?>"><i class="fa fa-cutlery"></i>เมนูอาหาร / เครื่องดื่ม</a></li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-file-text"></i> <span>รายงาน</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="<?php echo Url::to(['report/reportall']); ?>"><i class="fa fa-circle-o"></i> แสดงรายการขาย</a></li>
                                    <li><a href="<?php echo Url::to(['unit/index']); ?>"><i class="fa fa-circle-o"></i> ค้นหารายการขาย</a></li>
                                    <li><a href="<?php echo Url::to(['stockproduct/index']); ?>"><i class="fa fa-circle-o"></i> แสดงรายการขายแยกช่วงเวลา</a></li>
                                    <li><a href="<?php echo Url::to(['type/index']); ?>"><i class="fa fa-circle-o"></i> แสดงรายการขายแยกโต๊ะ</a></li>
                                    <li><a href="<?php echo Url::to(['tables/index']); ?>"><i class="fa fa-circle-o"></i> แสดงรายการขายแยกประเภท</a></li>
                                </ul>
                            </li>
                        </ul>
                    <?php } ?>
                </section>
                <!-- /.sidebar -->
            </aside><!--
              ##### content #####
            -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <!--
            <section class="content-header">
                
              <h1>
                Pace page
                <small>Loading example</small>
              </h1>
              <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Pace page</li>
              </ol>
            </section>
                -->
                <!-- Main content -->
                <section class="content">
                    <?=
                    Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ])
                    ?>
                    <?= Alert::widget() ?>
                    <?= $content ?>
                </section>
            </div>
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 2.3.3
                </div>
                <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
                reserved.
            </footer>
        </div>

        <?php $this->endBody() ?>

    </body>
</html>
<?php $this->endPage() ?>
