<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $tables
 * @property string $create_date
 * @property integer $confirm
 * @property integer $total
 * @property string $tel
 * @property integer $distcount
 *
 * @property Orderlist[] $orderlists
 */
class Report {

    //รายการขายทั้งหมด
    function GetListOrderAll() {
        
    }

    function Getincome() {
        $sql = "SELECT m.month_th,IFNULL(SUM(s.total),0) AS total
                FROM month m LEFT JOIN orders s ON m.id = SUBSTR(s.create_date,6,2)
                GROUP BY m.id ";
        return \Yii::$app->db->createCommand($sql)->queryAll();
    }

    function Getproduct() {
        $sql = "SELECT m.menu,IFNULL(Q2.TOTAL,0) AS total
                FROM menu m 

                LEFT JOIN (

                SELECT o.menu,COUNT(*) AS TOTAL
                FROM orderlist o 
                GROUP BY o.menu
                ) Q2

                ON m.id = Q2.menu

                ORDER BY Q2.TOTAL DESC ";

        return \Yii::$app->db->createCommand($sql)->queryAll();
    }
    
    function GetType(){
        $sql = "SELECT t.typename,IFNULL(Q2.total,0) AS total
                FROM type t

                LEFT JOIN

                (
                        SELECT m.type,SUM(Q2.TOTAL) AS total
                        FROM menu m 

                LEFT JOIN 
                        (
                        SELECT o.menu,COUNT(*) AS TOTAL
                        FROM orderlist o 
                        GROUP BY o.menu
                        ) Q2

                        ON m.id = Q2.menu
                        GROUP BY m.type
                ) Q2

                ON t.id = Q2.type";
        
        return \Yii::$app->db->createCommand($sql)->queryAll();
    }
    
    function Gettable(){
        $sql = "SELECT o.`tables`,COUNT(*) AS total
                FROM orders o 
                WHERE o.confirm = '1'
                GROUP BY o.`tables` ";
        
        return \Yii::$app->db->createCommand($sql)->queryAll();
    }

}
