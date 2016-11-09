<?php

namespace frontend\controllers;

use Yii;
use app\models\Orders;
use app\models\OrdersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use app\models\Tables;
use app\models\Orders as order;
use app\models\Orderlist;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Orders();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionOpenorders() {

        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->identity->id;
        } else {
            $user_id = "0";
        }

        $input = \Yii::$app->request;
        $tables = $input->post('tables');
        $ModelTables = new Tables();
        //Check Table Null
        $active = Tables::find()->where(['tables' => $tables])->one()['active'];
        if ($active == 1) {
            //getlastorder In tables 
            $orderID = $ModelTables->Getlastorder($tables);
        } else {
            $max = order::find()->select('order_id')->max('order_id');
            $orderID = ($max + 1);
            //Active Tables
            $data = array("active" => '1');
            \Yii::$app->db->createCommand()
                    ->update("tables", $data, "tables = '$tables' ")
                    ->execute();
            //Create Order 
            $columns = array(
                "order_id" => $orderID,
                "tables" => $tables,
                "user_id" => $user_id,
                "create_date" => date("Y-m-d H:i:s")
            );
            \Yii::$app->db->createCommand()
                    ->insert("orders", $columns)
                    ->execute();
        }
        $json = array('orderID' => $orderID);
        echo json_encode($json);
    }

    public function actionCheckbill() {
        $input = Yii::$app->request;
        $orderID = $input->post('orderID');

        $columns = array(
            "total" => $input->post('total'),
            "distcount" => $input->post('distcount'),
            "confirm" => '1',
            "income" => $input->post('income'),
            "change" => $input->post('change')
        );

        Yii::$app->db->createCommand()
                ->update("orders", $columns, "order_id = '$orderID' ")
                ->execute();
    }

    public function actionAddtel() {
        $input = Yii::$app->request;
        $orderID = $input->post('orderID');
        $columns = array(
            "tel" => $input->post('tel')
        );
        Yii::$app->db->createCommand()
                ->update("orders", $columns, "order_id = '$orderID' ")
                ->execute();

        $rs = order::findOne(['order_id' => $orderID]);
        $json = array("tel" => $rs['tel']);
        echo json_encode($json);
    }
    
    public function actionAddcustomer() {
        $input = Yii::$app->request;
        $orderID = $input->post('orderID');
        $columns = array(
            "customer" => $input->post('customer')
        );
        Yii::$app->db->createCommand()
                ->update("orders", $columns, "order_id = '$orderID' ")
                ->execute();

        $rs = order::findOne(['order_id' => $orderID]);
        $json = array("customer" => $rs['customer']);
        echo json_encode($json);
    }

    public function actionBill() {
        $orderlisModel = new Orderlist();
        $input = Yii::$app->request;
        $orderID = $input->post('orderID');
        $data['order'] = order::find()->where(['order_id' => $orderID])->one();
        $data['orderlist'] = $orderlisModel->Getdata($orderID);

        return $this->renderPartial('bill', $data);
    }

    public function actionEndorder() {
        $input = Yii::$app->request;
        $tables = $input->post('tables');
        $columns = array("active" => '0');
        \Yii::$app->db->createCommand()
                ->update("tables", $columns, "tables = '$tables'")
                ->execute();
    }

    public function actionAddoptions() {
        $input = Yii::$app->request;
        $columns = array(
            'menu' => $input->post('menu'),
            'order_id' => $input->post('orderID'),
            'options_id' => $input->post('options_id'),
            'orderlist_id' => $input->post('orderlist_id'),
            "create_date" => date('Y-m-d')
        );

        \Yii::$app->db->createCommand()
                ->insert("options", $columns)
                ->execute();
    }

    public function actionDeleteorder() {
        $input = Yii::$app->request;
        $tables = $input->post('tables');
        $orderID = $input->post('orderID');
        \Yii::$app->db->createCommand()
                ->delete("orders", "order_id = '$orderID' ")
                ->execute();

        $columns = array("active" => "0");
        \Yii::$app->db->createCommand()
                ->update("tables", $columns, "tables = '$tables' ")
                ->execute();
    }

    public function actionBuy() {
        $input = Yii::$app->request;
        $orderid = $input->post('orderid');
        $columns = array("flag" => "1");
        \Yii::$app->db->createCommand()
                ->update("orders", $columns, "order_id = '$orderid' ")
                ->execute();
    }

}
