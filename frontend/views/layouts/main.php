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
                    'class' => 'navbar-default navbar-default navbar-fixed-top',
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
                ['label' => "Date : " . $date],
                    //['label' => 'Contact', 'url' => ['/site/contact']],
            ];
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

            <div class="container-fluid" style="padding-top:60px;">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
