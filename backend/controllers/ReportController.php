<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use app\models\Orderlist;
use app\models\Orders;
class ReportController extends Controller {

    public function actionReportall() {
        return $this->render('reportall');
    }

    public function actionReportorder() {
        return $this->render('reportorder');
    }

    public function actionGetreport() {
        $input = \Yii::$app->request;
        $type = $input->post('type');
        $menu = $input->post('menu');
        $tables = $input->post('tables');
        $date_start = $input->post('date_start');
        $date_end = $input->post('date_end');
        $orders = $input->post('orders');
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

        if ($orders == '') {
            $Worders = "1=1";
        } else {
            $SOrders = implode("','", $orders);
            $Worders = "r.order_id IN('" . $SOrders . "')";
        }

        if ($tables == '') {
            $Wtables = "1=1";
        } else {
            $STtables = implode("','", $tables);
            $Wtables = "r.tables IN('" . $STtables . "')";
        }

        $Model = new Orderlist();
        $data['datas'] = $Model->Getlistorder($Wtype, $Wmenu, $Wtables, $date_start, $date_end, $Worders);
        return $this->renderPartial('_reportall', $data);
    }

    public function actionGetreportorder() {
        $input = \Yii::$app->request;

        $tables = $input->post('tables');
        $date_start = $input->post('date_start');
        $date_end = $input->post('date_end');

        if ($tables == '') {
            $Wtables = "1=1";
        } else {
            $STtables = implode("','", $tables);
            $Wtables = "r.tables IN('" . $STtables . "')";
        }

        $Model = new Orderlist();
        $data['datas'] = $Model->Getlistordergroup($Wtables, $date_start, $date_end);
        return $this->renderPartial('_reportorder', $data);
    }

    public function actionDetailorder() {
        $orderlisModel = new Orderlist();
        $input = Yii::$app->request;
        $orderID = $input->post('orderId');
        $data['order'] = Orders::find()->where(['order_id' => $orderID])->one();
        $data['orderlist'] = $orderlisModel->Getdata($orderID);

        return $this->renderPartial('_detailorder', $data);
    }

}
