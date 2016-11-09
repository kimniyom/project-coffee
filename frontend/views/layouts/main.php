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
$category = app\models\Type::find()->where(['active' => '1'])->all();
if (!Yii::$app->user->isGuest) {
    $user_id = Yii::$app->user->identity->id;
    $ProfileModel = new \dektrium\user\models\Profile();
    $Profile = $ProfileModel->findOne(['user_id' => $user_id]);
}
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
        <style type="text/css">
            html,body{
                /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#eeeeee+0,cccccc+100;Gren+3D */
                background: #63636f; /* Old browsers */
                background: -moz-linear-gradient(top,  #63636f 0%, #474653 100%); /* FF3.6-15 */
                background: -webkit-linear-gradient(top,  #63636f 0%,#474653 100%); /* Chrome10-25,Safari5.1-6 */
                background: linear-gradient(to bottom,  #63636f 0%,#474653 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#63636f', endColorstr='#474653',GradientType=0 ); /* IE6-9 */
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-position: center;      
            }
            @media screen and (max-width: 1024px) {
                #textnav{
                    display: none;
                }
            }

            @media screen and (min-width: 1024px) {
                #textnav{
                    display: inline;
                }
            }

            #repeat:hover{
                color: #212121;
                text-decoration: none;
            }

           
.activemenu{
    background:#2b9cf9;
    color:#999;
}
.activemenu #menuleft{
    background: #2b9cf9;
    color: #ffffff;
}
        </style>
    </head>
    <body class="skin-blue fixed" id="mainpage">
        <?php $this->beginBody() ?>

        <div class="wrapper" style=" background: none;">
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
                    <span class="logo-lg" style=" color: #ffbf2f; font-weight: bold;"><?php echo $setting->DetailShop('shopname') ?></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-inverse navbar-static-top" style=" background: #474754;">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" >
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        เมนู
                    </a>

                    <div class="navbar-custom-menu" style="background:#474754;">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" id="menunav" class="dropdown-toggle" data-toggle="dropdown">
                                    <?php
                                    if (!Yii::$app->user->isGuest) {
                                        echo '<img src="' . Url::to('@web/web/images/user-icon.png') . '" height="18"/>';
                                        echo Yii::$app->user->identity->username;
                                    } else {
                                        echo '<img src="' . Url::to('@web/web/images/user-icon.png') . '" height="18"/>';
                                        echo "Admin";
                                    }
                                    ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <?php
                                    //if (!Yii::$app->user->isGuest) {
                                    echo '<li>'
                                    . Html::beginForm(['/site/logout'], 'post')
                                    . Html::submitButton(
                                            '<i class="fa fa-exchange"></i> เปลี่ยนผู้ใช้งาน', ['class' => 'btn btn-link', 'id' => 'repeat']
                                    )
                                    . Html::endForm()
                                    . '</li>';
                                    //}
                                    ?>
                                </ul>
                            </li>


                            <li>
                                <a href="javascript:window.location.reload();"
                                   onclick="Activemenu('m2')" id="menunav">
                                    <img src="<?php echo Url::to('@web/web/images/refresh-icon.png') ?>" height="18"/> <font id="textnav">Refresh</font></a>
                            </li>

                            <?php
                            /*
                              if (!Yii::$app->user->isGuest) {
                              if ($Profile['status'] == "A") {
                             * 
                             */
                            ?>
                            <li>
                                <a href="<?php echo $config->LinktoBackend(Yii::$app->urlManager->createUrl('site')) ?>" id="menunav">
                                    <img src="<?php echo Url::to('@web/web/images/settings-icon.png') ?>" height="18"/> <font id="textnav">Backoffice</font></a>
                            </li>
                            <?php
                            /*
                              }
                              }
                             * 
                             */
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
            <aside class="main-sidebar" style="background: #29272d; /*background: url(<?//php echo Url::to('@web/web/images/bg-sidebar.png') ?>) fixed left bottom no-repeat #000000*/" id="menuleft">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel" style="background: #424242;">
                        <div class="pull-left image">
                            <img src="<?php echo Url::to('@web/themes/AdminLTE/dist/img/avatar04.png') ?>" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>
                                <?php
                                if (!Yii::$app->user->isGuest) {
                                    echo $Profile['name'] . "</br>";
                                    if ($Profile['status'] == "M")
                                        echo "พนักงาน";
                                    else
                                        echo "ผู้ดูแลระบบ";
                                } else {
                                    echo "Admin";
                                }
                                ?>
                                <i class="fa fa-circle text-success"></i> Online
                            </p>
                        </div>
                    </div>
                    <!-- search form -->
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="header" style=" font-size: 20px; color: #FFFFFF;"><i class="fa fa-coffee"></i> อาหาร / เครื่องดื่ม</li>
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
                            <li onclick="Activemenu('<?php echo $cat['id'] ?>', '<?php echo $cat['typename'] ?>')" class="ac" id="<?php echo $cat['id'] ?>" style=" text-align: center; border-bottom: #424242 solid 1px;">
                                <a href="#" id="menuleft">
                                    <center><img src="<?php echo $config->GetimagesProduct($cat['images']) ?>" style=" width: 64px;" class="img-responsive"/></center>
                                    <b><?php echo $cat['typename'] ?></b></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                </section>
                <!-- /.sidebar -->
            </aside><!--
              ##### content #####
            -->
            <div class="content-wrapper" style=" background: none;">
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



