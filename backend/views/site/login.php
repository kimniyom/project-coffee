<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//use backend\assets\AppAsset;
use backend\assets\AdminLteAsset;

AdminLteAsset::register($this);
$this->title = 'LoginBackoffice';
//$this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="hold-transition login-page">
        <?php $this->beginBody() ?>
        <div class="login-box">
            <div class="login-logo">
                <a href="../../index2.html"><?= Html::encode($this->title) ?></a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">

                <div class="row">

                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <?= $form->field($model, 'rememberMe')->checkbox() ?>

                    <div class="form-group">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
