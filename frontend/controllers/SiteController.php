<?php

namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Tables;
use app\models\Orders;
use yii\db\Query;
use app\models\Orderlist;
use yii\helpers\Json;
use common\models\Setting;
use app\models\Menu;
use common\models\System;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionTables($tables = null, $order = null) {

        //$data['id'] = $id;
        $orders = Orders::find()->where(['order_id' => $order])->one();
        $data['model'] = $orders;
        $data['order_id'] = $order;
        $data['tables'] = $tables;

        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->identity->id;
            $columns = array("user_id" => $user_id);
            if (empty($orders['user_id']) || $orders['user_id'] == "0") {
                \Yii::$app->db->createCommand()
                        ->update("orders", $columns, "order_id = '$order' ")
                        ->execute();
            }
        }



        return $this->render('index', $data);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {
        Yii::$app->user->logout();
        $system = new System();
        $link = $system->LinktoBackend(Yii::$app->urlManager->createUrl('site'));
        $this->redirect($link);
        //return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout() {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup() {
        $this->layout = "backend";
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

    public function actionIndex() {
        $Setting = new Setting();
        $data['typeBuy'] = $Setting->DetailShop('defaulttable');
        $data['tables'] = Tables::find()->all();
        //$data['tables'] = Tables::find()->where(['!=', 'tables', '0'])->all();
        return $this->render("tables", $data);
    }

    public function actionCalculator() {

        $post = \Yii::$app->request;
        $orderID = $post->post('orderID');
        $Model = new Orderlist();
        $total = $Model->Getsumorder($orderID);
        $order = Orders::find()->where(['order_id' => $orderID])->one();
        $json = array(
            "total" => $total,
            "income" => $order['income'],
            "confirm" => $order['confirm'],
            "tel" => $order['tel'],
            "customer" => $order['customer']
        );
        echo json_encode($json);
    }

    public function actionActivemenu() {
        $catID = \Yii::$app->request->post('catID');
        Yii::$app->session['fmenu'] = $catID;
    }

    public function actionGetitems() {
        $catID = \Yii::$app->request->post('catid');
        $menu = new Menu();
        $data['product'] = $menu->Getmenu($catID);
        return $this->renderPartial('product', $data);
    }

}
