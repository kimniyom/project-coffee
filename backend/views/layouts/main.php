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
    <body class="skin-blue fixed">
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

            <header class="main-header" style=" background: #212121;">
                <!-- Logo -->
                <a href="../../index2.html" class="logo" style=" background: #212121;">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>C</b>offee</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Coffee</b>BackOffice</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" style=" background: #212121;">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <div class="navbar-custom-menu" style="background: #3e2723;">
                        <ul class="nav navbar-nav">
                            <li <?php
                            if (Yii::$app->session['menu'] == 'm0') {
                                echo "class='Mactive'";
                            }
                            ?>>
                                <a href="<?php echo Url::to(['cutstock/index']) ?>"
                                   onclick="Activemenu('m0')" id="menunav">
                                    <img src="<?php echo Url::to('@web/images/shop-icon.png') ?>" height="18"/> <i class="fa fa-cut"></i> ตัดสต๊อก</a>
                            </li>
                            <li <?php
                            if (Yii::$app->session['menu'] == 'm1') {
                                echo "class='Mactive'";
                            }
                            ?>>
                                <a href="<?php echo Url::to(['stock/index']) ?>"
                                   onclick="Activemenu('m1')" id="menunav">
                                    <img src="<?php echo Url::to('@web/images/shop-icon.png') ?>" height="18"/> เช็คสต๊อกสินค้า</a>
                                    <img src="<?php echo Url::to('@web/images/shop-icon.png') ?>" height="18"/> เช็ค / เพิ่ม สต๊อกสินค้า</a>
                            </li>
                            <li <?php
                            if (Yii::$app->session['menu'] == 'm2') {
                                echo "class='Mactive'";
                            }
                            ?>>
                                <a href="<?php echo Url::to(['menu/index']) ?>"
                                   onclick="Activemenu('m2')" id="menunav">
                                    <img src="<?php echo Url::to('@web/images/food-icon.png') ?>" height="18"/> เมนูอาหาร / เครื่องดื่ม</a>
                            </li>
                            <li <?php
                            if (Yii::$app->session['menu'] == 'm3') {
                                echo "class='Mactive'";
                            }
                            ?>>
                                <a href="<?php echo Url::to(['employee/index']) ?>"
                                   onclick="Activemenu('m3')" id="menunav">
                                    <img src="<?php echo Url::to('@web/images/users-icon.png') ?>" height="18"/> ข้อมูลพนักงาน</a>
                            </li>
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
            <aside class="main-sidebar" style=" background: #424242;">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel" style=" background: #424242;">
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
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <?php
                    if (!\Yii::$app->user->isGuest) {
                        $style = " class='activemenu'";
                        ?>
                        <ul class="sidebar-menu">
                            <li class="header"><i class="fa fa-gear"></i> ตั้งค่า</li>
                            <!--
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-gear"></i> <span>ตั้งค่า</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                            <!--
                            <ul class="treeview-menu">
                                
                            </ul>
                            
                        </li>
                            -->
                            <li <?php
                            if (Yii::$app->session['menu'] == '1') {
                                echo $style;
                            }
                            ?>><a href="<?php echo Url::to(['category/index']); ?>" id="menuleft" onclick="Activemenu('1')"><i class="fa fa-circle-o text-green"></i> หมวดสินค้า</a></li>
                            <li <?php
                            if (Yii::$app->session['menu'] == '2') {
                                echo $style;
                            }
                            ?>><a href="<?php echo Url::to(['unit/index']); ?>" id="menuleft" onclick="Activemenu('2')"><i class="fa fa-circle-o text-green"></i> หน่วยนับ</a></li>
                            <li <?php
                            if (Yii::$app->session['menu'] == '3') {
                                echo $style;
                            }
                            ?>><a href="<?php echo Url::to(['stockproduct/index']); ?>" id="menuleft" onclick="Activemenu('3')"><i class="fa fa-circle-o text-green"></i> สินค้า</a></li>
                            <li <?php
                            if (Yii::$app->session['menu'] == '4') {
                                echo $style;
                            }
                            ?>><a href="<?php echo Url::to(['type/index']); ?>" id="menuleft" onclick="Activemenu('4')"><i class="fa fa-circle-o text-green"></i> ประเภทรายการสินค้า</a></li>
                            <li <?php
                            if (Yii::$app->session['menu'] == '5') {
                                echo $style;
                            }
                            ?>><a href="<?php echo Url::to(['tables/index']); ?>" id="menuleft" onclick="Activemenu('5')"><i class="fa fa-circle-o text-green"></i> โต๊อาหาร</a></li>
                            <li <?php
                            if (Yii::$app->session['menu'] == '6') {
                                echo $style;
                            }
                            ?>><a href="<?php echo Url::to(['menuoptions/index']); ?>" id="menuleft" onclick="Activemenu('6')"><i class="fa fa-circle-o text-green"></i> Options เพิ่มเติม</a></li>
                            <li <?php
                            if (Yii::$app->session['menu'] == '7') {
                                echo $style;
                            }
                            ?>><a href="<?php echo Url::to(['setting/view', 'id' => 1]); ?>" id="menuleft" onclick="Activemenu('7')"><i class="fa fa-gears text-red"></i> ตั้งค่าร้านค้า</a></li>

                            <!--
                            <li><a href="<?//php echo Url::to(['stock/index']) ?>"><i class="fa fa-cube"></i>Stock</a></li>
                            <li><a href="<?//php echo Url::to(['menu/index']) ?>"><i class="fa fa-cutlery"></i>เมนูอาหาร / เครื่องดื่ม</a></li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-file-text"></i> <span>รายงาน</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="<?//php echo Url::to(['report/reportall']); ?>"><i class="fa fa-circle-o"></i> แสดงรายการขาย</a></li>
                                </ul>
                            </li>
                            -->
                            <li class="header"><i class="fa fa-file-o"></i> รายงาน</li>
                            <li <?php
                            if (Yii::$app->session['menu'] == '7') {
                                echo $style;
                            }
                            ?>><a href="<?php echo Url::to(['report/reportall']); ?>" id="menuleft" onclick="Activemenu('7')"><i class="fa fa-file text-yellow"></i> รายงานการขาย</a></li>
                            <?phpif (Yii::$app->session['menu'] == '8') {
                                echo $style;
                            }
                            ?><a href="<?php echo Url::to(['report/reportall']); ?>" id="menuleft" onclick="Activemenu('8')"><i class="fa fa-file text-yellow"></i> รายงานการขาย</a></li>
                        </ul>
                    <?php } ?>
                </section>
                <!-- /.sidebar -->
            </aside><!--
              ##### content #####
            -->
            <div class="content-wrapper" style=" background: #FFFFFF;">
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

<script type="text/javascript">
    function Activemenu(id) {
        var url = "<?php echo Url::to(['site/activemenu']) ?>";

        var data = {menu: id};
        $.post(url, data, function (result) {
            //alert(result);
        });
    }
</script>
