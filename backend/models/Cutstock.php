<?php

namespace app\models;

use Yii;
use app\models\Stock;

/**
 * This is the model class for table "orderlist".
 *
 * @property integer $id
 * @property integer $order
 * @property integer $menu
 *
 * @property Options[] $options
 * @property Orders $order0
 */
class Cutstock extends \yii\db\ActiveRecord {

    public function GetStock() {
        $sql = "SELECT o.*,m.menu AS menuname,m.price,t.typename,r.tables
                    FROM orders r INNER JOIN orderlist o ON r.order_id = o.order
                    INNER JOIN menu m ON o.menu = m.id
                    INNER JOIN type t ON m.type = t.id 
                    WHERE o.flagstock = 'N' ";
        return \Yii::$app->db->createCommand($sql)->queryAll();
    }

    public function Checkstock($productID = null, $number = null) {
        //$stock = Stock::find()->where(['product' => $productID])->one();
        $sql = "SELECT SUM(s.total) AS total
                FROM stock s 
                WHERE s.product = '$productID'
                GROUP BY s.product";
        $rs = \Yii::$app->db->createCommand($sql)->queryOne();
        $stock = $rs['total'];
        if ($number > $stock) {
            return "0";
        } else {
            return "1";
        }
    }

    public function Cutstock($productID = null, $number = null) {
        $sqlcount = "SELECT s.id,COUNT(*) AS TOTAL
                FROM stock s 
                WHERE s.product = '$productID' AND s.total > '0'";
        $rscount = \Yii::$app->db->createCommand($sqlcount)->queryOne();
        $count = $rscount['TOTAL'];
        if ($count == 1) {
            $id = $rscount['id'];
            $stock = Stock::find()->where(['id' => $id])->one();
            $total = $stock['total'];
            $cutstock = ($total - $number);
            $columns = array("total" => $cutstock);
            Yii::$app->db->createCommand()
                    ->update("stock", $columns, "id = '$id'")
                    ->execute();
        } else {
            $sql = "SELECT *
                FROM stock s 
                WHERE s.product = '$productID' AND s.total > '0' ORDER BY s.id ASC";
            $result = \Yii::$app->db->createCommand($sql)->queryAll();

            foreach ($result as $rs):
                $totals = $rs['total'];
                $id = $rs['id'];
                if ($totals >= $number) {
                    $cutstocks = ($totals - $number);
                    $columnss = array("total" => $cutstocks);
                    Yii::$app->db->createCommand()
                            ->update("stock", $columnss, "id = '$id'")
                            ->execute();
                    break;
                } else {
                    $cutstocks = ($number - $totals);
                    $columnss = array("total" => '0');
                    Yii::$app->db->createCommand()
                            ->update("stock", $columnss, "id = '$id'")
                            ->execute();
                }
            endforeach;
        }

        //return $count;
    }

    public function Getmixser($menuId = null) {
        $sql = "SELECT p.productname,SUM(s.total) AS total,m.number
                FROM mix m INNER JOIN stock s ON m.product_stock_id = s.product
                INNER JOIN stockproduct p ON s.product = p.id
                WHERE m.menu = '$menuId'
                GROUP BY s.product ";
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        return $result;
    }

    public function GetstockInType($typeId = null) {
        $sql = "SELECT o.*,m.menu AS menuname,m.price,t.typename,r.tables
                    FROM orders r INNER JOIN orderlist o ON r.order_id = o.order
                    INNER JOIN menu m ON o.menu = m.id
                    INNER JOIN type t ON m.type = t.id 
                    WHERE o.flagstock = 'N' AND t.id = '$typeId'";
        return \Yii::$app->db->createCommand($sql)->queryAll();
    }

}
