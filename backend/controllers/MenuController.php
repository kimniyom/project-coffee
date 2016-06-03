<?php

namespace backend\controllers;

use Yii;
use app\models\Menu;
use app\models\MenuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Mix;
use app\models\MixSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends Controller {

    public $enableCsrfValidation = false;

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
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new MenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Menu model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $mixModel = new Mix();
        $searchModel = new MixSearch();
        $query = Mix::find()->where(['menu' => $id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'mixModel' => $mixModel,
        ]);
    }

    /**
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionFormcreate() {
        $type = \app\models\Type::find()->all();
        $model = new Menu();
        $searchModel = new MenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('_formcreate', [
                    'type' => $type,
                    'model' => $model,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSave() {
        $post = Yii::$app->request;
        //$model = new Menu();
        //$searchModel = new MenuSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $columns = array(
            "menu" => $post->post('menu'),
            "type" => $post->post('type'),
            "options" => $post->post('options'),
            "price" => $post->post('price'),
            "create_date" => date('Y-m-d')
        );

        Yii::$app->db->createCommand()
                ->insert("menu", $columns)
                ->execute();

        $query = new \yii\db\Query();
        $lastmenu = $query->select('*')
                ->from("menu")
                ->orderBy('id DESC')
                ->limit("1")
                ->one();


        if ($lastmenu['options'] == '1') {
            $json = array("id" => $lastmenu['id'], "options" => $lastmenu['options']);
            echo Json::encode($json);
            //return $this->redirect(['options', 'id' => $lastmenu->id]);
        } else {
            $json = array('id' => '', 'options' => '');
            echo json_encode($json);
        }
    }

    public function actionOptions($id) {
        return $this->render('options', [
                    'model' => $this->findModel($id),
        ]);
        
        
    }

    public function actionCreate() {
        $model = new Menu();
        $searchModel = new MenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if ($model->load(Yii::$app->request->post())) {
            $model->create_date = date("Y-m-d");
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Updates an existing Menu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $searchModel = new MenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Deletes an existing Menu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
