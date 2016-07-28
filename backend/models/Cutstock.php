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
        $stock = Stock::find()->where(['product' => $productID])->one();
        if($number > $stock['total']){
            return "0";
        } else {
            return "1";
        }
    }

    public function Cutstock($productID = null, $number = null) {
        $stock = Stock::find()->where(['product' => $productID])->one();
        $total = $stock['total'];
        $cutstock = ($total - $number);
        $columns = array("total" => $cutstock);
        Yii::$app->db->createCommand()
                ->update("stock", $columns, "product = '$productID'")
                ->execute();


        //return $count;
    }
    
    public function Getmixser($menuId = null){
        $sql = "SELECT p.productname,s.total,m.number
                FROM mix m INNER JOIN stock s ON m.product_stock_id = s.product
                INNER JOIN stockproduct p ON s.product = p.id
                WHERE m.menu = '$menuId' ";
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        return $result;
    }
    
    public function GetstockInType($typeId = null){
        $sql = "SELECT o.*,m.menu AS menuname,m.price,t.typename,r.tables
                    FROM orders r INNER JOIN orderlist o ON r.order_id = o.order
                    INNER JOIN menu m ON o.menu = m.id
                    INNER JOIN type t ON m.type = t.id 
                    WHERE o.flagstock = 'N' AND t.id = '$typeId'";
        return \Yii::$app->db->createCommand($sql)->queryAll();
    }

}
