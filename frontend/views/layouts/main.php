<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\assets\AdminLteAsset;
use common\widgets\Alert;
use common\models\System;
use yii\helpers\Url;
use yii\web\UrlManager;
use common\models\Setting;

AppAsset::register($this);
AdminLteAsset::register($this);
$config = new System();
$setting = new Setting();
$category = \app\models\Category::findAll(['status' => '1']);
$ActiveCat = \app\models\Category::find(['status' => '1', 'active' => '1'])->one();
$categoryActive = $ActiveCat['id'];
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


            $urlBE = Url::to('@web/uploads', TRUE);
            $logo = $config->LinktoBackend($urlBE . '/' . $setting->DetailShop('logo'));
            ?>

            <header class="main-header" style=" background: #212121;">
                <!-- Logo -->
                <a href="#" class="logo" style=" background: #212121;">
                    <img src="<?php echo $logo ?>" class="img-responsive" style="width: 38px; position: absolute;  top: 5px; left: 5px;"/>
                    <span class="logo-lg"><?php echo $setting->DetailShop('shopname') ?></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" style=" background: #212121;">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" >
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
                                <a href="javascript:(0)"
                                   onclick="Activemenu('m0')" id="menunav">
                                       <?php
                                       if (!Yii::$app->user->isGuest) {
                                           echo '<img src="' . Url::to('@web/web/images/user-icon.png') . '" height="18"/>';
                                           echo Yii::$app->user->identity->username;
                                       } else {
                                           echo '<img src="' . Url::to('@web/web/images/user-icon.png') . '" height="18"/>';
                                           echo "Admin";
                                       }
                                       ?></a>
                            </li>
                            <li <?php
                            if (Yii::$app->session['menu'] == 'm2') {
                                echo "class='Mactive'";
                            }
                            ?>>
                                <a href="javascript:window.location.reload();"
                                   onclick="Activemenu('m2')" id="menunav">
                                    <img src="<?php echo Url::to('@web/web/images/refresh-icon.png') ?>" height="18"/> Refresh</a>
                            </li>
                            <li <?php
                            if (Yii::$app->session['menu'] == 'm3') {
                                echo "class='Mactive'";
                            }
                            ?>>
                                <a href="<?php echo $config->LinktoBackend(Yii::$app->urlManager->createUrl('site')) ?>"
                                   onclick="Activemenu('m3')" id="menunav">
                                    <img src="<?php echo Url::to('@web/web/images/settings-icon.png') ?>" height="18"/> Backoffice</a>
                            </li>
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
                        <?php
                        $style = " class='activemenu'";
                        $i = 0;
                        foreach ($category as $cat): $i++;
                            ?>
                            <li onclick="Activemenu('<?php echo $cat['id'] ?>','<?php echo $cat['cat_name'] ?>')" class="ac" id="<?php echo $cat['id'] ?>"><a href="#" id="menuleft"><i class="fa fa-circle-o text-green"></i> <?php echo $cat['cat_name'] ?></a></li>
                        <?php endforeach; ?>
                    </ul>

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
    $(document).ready(function () {
        Activemenu('<?php echo $categoryActive ?>', '<?php echo $ActiveCat['cat_name'] ?>');
        Getitems('<?php echo $categoryActive ?>');
    });
</script>

