<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use app\models\Orderlist;

class ReportController extends Controller {

    public function actionReportall() {
        $Model = new Orderlist();
        $data['datas'] = $Model->Getlistorder();
        return $this->render('reportall', $data);
    }

}
