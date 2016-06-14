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

}
