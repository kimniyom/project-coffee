<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use app\models\Orderlist;

class ReportController extends Controller {

    public function actionReportall() {
        return $this->render('reportall');
    }

    public function actionGetreport() {
        $input = \Yii::$app->request;
        $type = $input->post('type');
        $menu = $input->post('menu');
        $tables = $input->post('tables');
        $date_start = $input->post('date_start');
        $date_end = $input->post('date_end');

        if ($type == '') {
            $Wtype = "1=1";
        } else {
            $STtype = implode("','", $type);
            $Wtype = "t.id IN('" . $STtype . "')";
        }

        if ($menu == '') {
            $Wmenu = "1=1";
        } else {
            $STmenu = implode("','", $menu);
            $Wmenu = "o.menu IN('" . $STmenu . "')";
        }

        if ($tables == '') {
            $Wtables = "1=1";
        } else {
            $STtables = implode("','", $tables);
            $Wtables = "r.tables IN('" . $STtables . "')";
        }

        $Model = new Orderlist();
        $data['datas'] = $Model->Getlistorder($Wtype, $Wmenu, $Wtables, $date_start, $date_end);
        return $this->renderPartial('_reportall', $data);
    }

}
