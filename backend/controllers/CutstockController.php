<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use app\models\Cutstock;
use app\models\Mix;

class CutstockController extends Controller {

    public function actionIndex() {
        $Model = new Cutstock();
        $data['datas'] = $Model->GetStock();
        return $this->render('index', $data);
    }

    public function actionCheckstock() {
        $cusModel = new Cutstock();
        $menu = Yii::$app->request->post('menuid');
        $orderid = Yii::$app->request->post('orderid');
        $mix = Mix::find()->where(['menu' => $menu])->all();
        $checkstatus = "";
        foreach ($mix as $m):
            $checkstock = $cusModel->Checkstock($m['product_stock_id'], $m['number']);
            $status = $checkstock;
            if ($status == 0) {
                $checkstatus = "0";
                break;
            } else {
                $checkstatus = $status;
            }
        endforeach;

        if ($checkstatus != '0') {
            $this->actionCutstock($orderid, $menu);
        } else {
            echo $checkstatus;
        }

        //Update Flag
        /*
          $columns = array("flagstock" => 'Y');
          Yii::$app->db->createCommand()
          ->update("orderlist", $columns, ['order' => $orderid, 'menu' => $menu])
          ->execute();
         * 
         */
    }

    public function actionCutstock($orderid = null, $menu = null) {
        $cusModel = new Cutstock();
        //$menu = Yii::$app->request->post('menuid');
        //$orderid = Yii::$app->request->post('orderid');
        $mix = Mix::find()->where(['menu' => $menu])->all();

        foreach ($mix as $m):
            $cusModel->Cutstock($m['product_stock_id'], $m['number']);
        endforeach;

        //Update Flag
        $columns = array("flagstock" => 'Y');
        Yii::$app->db->createCommand()
                ->update("orderlist", $columns, ['order' => $orderid, 'menu' => $menu])
                ->execute();
    }

    public function actionListorder() {
        $menuid = Yii::$app->request->post('menuid');
        $Model = new Cutstock();
        $mixser = $Model->Getmixser($menuid);
        $str = "<table class='table'>";
        $str .="<thead><tr>";
        $str .="<th>#</th>";
        $str .="<th>วัตถุดิบ</th>";
        $str .="<th id='textcenter'>คงเหลือในสต๊อก</th>";
        $str .="<th id='textcenter'>จำนวนตัดสต๊อก</th>";
        $str .="<th></th>";
        $str .="</tr>";
        $str ."<tbody>";
        $i=0;
        foreach ($mixser as $m):
            $i++;
        if($m['total'] < $m['number']){
            $color = "style='color:red;'";
            $icon = "<i class='fa fa-remove text-red'></i>";
        } else {
            $color = "";
            $icon = "<i class='fa fa-check text-green'></i>";
        }
            $str .="<tr>";
            $str .="<td>".$i."</td>";
            $str .="<td $color>".$m['productname']."</td>";
            $str .="<td id='textright' $color>".$m['total']."</td>";
            $str .="<td id='textright'>".$m['number']."</td>";
            $str .="<td id='textcenter'>".$icon."</td>";
            $str .="<tr/>";
        endforeach;
        $str .= "</tbody></table>";
        echo $str;
    }
    
    public function actionStockintype(){
        $typeId = Yii::$app->request->post('type');
        $Model = new Cutstock();
        $data['datas'] = $Model->GetstockInType($typeId);
        return $this->renderPartial('stockintype',$data);
    }

}
