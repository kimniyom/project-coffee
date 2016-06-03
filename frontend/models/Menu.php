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

}
