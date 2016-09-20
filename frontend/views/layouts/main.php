<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use common\models\System;
use yii\helpers\Url;
use yii\web\UrlManager;

AppAsset::register($this);
$config = new System();
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
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">

            <?php
            NavBar::begin([
                'brandLabel' => 'DemoCoffee',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar navbar-inverse navbar-fixed-top',
                ],
                'innerContainerOptions' => ['class' => 'container-fluid'],
            ]);
            $date = $config->Thaidate(date("Y-m-d H:i:s"));

            $menuItems = [
                /*
                  [
                  //'label' => 'Home',
                  //'url' => ['/site/index'],
                  //'id' => 'btnhome',
                  //'options' => ['id' => 'btnhome'],
                  ],
                 * 
                 */
                '<li><a href="javascript:window.location.reload();"><i class="fa fa-refresh"></i> Refresh</a></li>',
                ['label' => "Date : " . $date],
            ];
            $menuItems[] = ['label' => 'BackOffice', 'url' => $config->LinktoBackend(Yii::$app->urlManager->createUrl('site'))];
            //if (Yii::$app->session['admin'] == "TRUE") {
            //}
            /*
              if (Yii::$app->user->isGuest) {
              $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
              $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
              } else {
              $menuItems[] = '<li>'
              . Html::beginForm(['/site/logout'], 'post')
              . Html::submitButton(
              'Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link']
              )
              . Html::endForm()
              . '</li>';
              }
             * 
             */
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);

            NavBar::end();
            ?>

            <div class="navbar navbar-inverse"></div>
            <div class="navbar navbar-fixed-top navbar-default" style=" margin-top: 50px; z-index: 10;">
                <div class="navbar-custom-menu container-fluid">
                    <ul class="nav navbar-nav pull-right">
                        <li>
                            <a href="#">
                                ผู้ใช้งาน :
                                <?php if (isset(Yii::$app->session['employee'])) { ?>
                                    <?php echo Yii::$app->session['employee'] ?> 
                                <?php } else { ?>
                                    Admin
                                <?php } ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="container" style="padding-top:40px;">
                <div id="padding"></div>
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>

        <!--
        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; My Company <?//= date('Y') ?></p>

                <p class="pull-right"><?//= Yii::powered() ?></p>
            </div>
        </footer>
        -->
        <div class="navbar navbar-fixed-bottom navbar-inverse">
            <div class="container" style=" padding-top: 7px;">
                <button type="button" class="btn btn-info">สั่ง</button>
                <button type="button" class="btn btn-success">ชำระเงิน</button>
                <button type="button" class="btn btn-warning">พิมพ์</button>
                <div class="pull-right">
                    <button type="button" class="btn btn-default"><i class="fa fa-check"></i> สิ้นสุดการขาย</button>
                    <button type="button" class="btn btn-danger"><i class="fa fa-remove"></i> ยกเลิก</button>
                </div>
            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>


