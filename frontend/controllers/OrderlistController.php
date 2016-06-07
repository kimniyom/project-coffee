<?php

namespace frontend\controllers;

use Yii;
use app\models\Orderlist;
use app\models\OrderlistSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Mix;
use app\models\Stock;
/**
 * OrderlistController implements the CRUD actions for Orderlist model.
 */
class OrderlistController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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
     * Lists all Orderlist models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderlistSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orderlist model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Orderlist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orderlist();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Orderlist model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
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
     * Deletes an existing Orderlist model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orderlist model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orderlist the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orderlist::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionLoad(){
        $post = \Yii::$app->request;
        $orderid = $post->post('orderID');
        $Model = new Orderlist();
        $data['orderlist'] = $Model->Getdata($orderid);
        return $this->renderPartial('loadorderlist',$data);
    }
    
    public function actionSave(){
        $post = \Yii::$app->request;
        $stockModel = new Stock();
        /*นำเมนูไปหาส่วนประกอบแต่ละอย่างเพื่อนำไปเช็ค Stock */
        $menuID = $post->post('menu');
        $mix = Mix::find()->where(['menu' => $menuID])->all();
        
        foreach($mix as $m):
            
        endforeach;
        
        $columns = array(
            "order" => $post->post('order_id'),
            "menu" => $menuID
        );
        
        \Yii::$app->db->createCommand()
                ->insert("orderlist", $columns)
                ->execute();
    }
    
    public function actionDeleteorderlist(){
        $post = \Yii::$app->request;
        $id = $post->post('id');
        \Yii::$app->db->createCommand()
                ->delete("orderlist", "id = $id")
                ->execute();
    }
}
