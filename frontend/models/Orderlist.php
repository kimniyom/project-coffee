<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orderlist".
 *
 * @property integer $id
 * @property integer $order
 * @property integer $menu
 */
class Orderlist extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'orderlist';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id'], 'required'],
            [['id', 'order', 'menu'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'order' => 'Order',
            'menu' => 'Menu',
        ];
    }

    public function Getdata($orderID = null) {
        $sql = "SELECT o.*,m.menu AS menuname,m.price,m.images,r.confirm
                FROM orderlist o INNER JOIN menu m ON o.menu = m.id 
                INNER JOIN orders r ON o.order = r.order_id
                WHERE o.order = '$orderID' ";
        $result = \Yii::$app->db->createCommand($sql)
                ->queryAll();
        return $result;
    }

    public function Getsumorder($orderID = null) {
        $sql = "SELECT IFNULL(SUM(price),0) AS TOTAL
                FROM orderlist o INNER JOIN menu m ON o.menu = m.id
                WHERE o.order = '$orderID' ";
        $result = \Yii::$app->db->createCommand($sql)
                ->queryOne();
        return $result['TOTAL'];
    }

}
