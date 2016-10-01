<?php

namespace app\models;

use Yii;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Menu {

    public function Getmenu($type = null) {
        $sql = "SELECT * FROM menu WHERE type = '$type' ";
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        return $result;
    }
    
    public function CheckCub($menuid = null){
        $sql = "SELECT IFNULL((ROUND(Q1.total/x.number,0)),0) AS CUB
            FROM menu m INNER JOIN mix x ON m.id = x.menu

            INNER JOIN 

            (
               SELECT s.product,SUM(s.total) AS total 
               FROM stock s 
               WHERE s.total > 0 
               GROUP BY s.product
            ) Q1

            ON x.product_stock_id = Q1.product


            WHERE m.id = '$menuid'
            ORDER BY CUB ASC 
            LIMIT 1 ";
        
        $rs = \Yii::$app->db->createCommand($sql)->queryOne();
        return $rs['CUB'];
    }

}
