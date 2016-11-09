<?php

namespace app\models;

use Yii;

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
            [['order', 'menu'], 'integer'],
            [['create_date', 'tel'], 'safe'],
            [['order'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['order' => 'order_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'order' => 'รหัสสั่งซื้อ',
            'menu' => 'รหัสเมนู',
            'create_date' => 'วันที่ขาย',
            'flagstock' => 'ตัดสต๊อก'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptions() {
        return $this->hasMany(Options::className(), ['orderlist_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder0() {
        return $this->hasOne(Orders::className(), ['order_id' => 'order']);
    }

    public function Getlistorder($Wtype = null, $Wmenu = null, $Wtable = null, $date_start = null, $date_end = null, $Worders = null) {
        $sql = "SELECT o.*,m.menu AS menuname,m.price,t.typename,r.tables
                    FROM orders r INNER JOIN orderlist o ON r.order_id = o.order
                    INNER JOIN menu m ON o.menu = m.id
                    INNER JOIN type t ON m.type = t.id 
                    WHERE $Wtype 
                        AND $Wmenu
                        AND $Wtable
                        AND $Worders
                        AND o.create_date BETWEEN '$date_start' AND '$date_end' ";
        return \Yii::$app->db->createCommand($sql)->queryAll();
    }

    public function Getlistordergroup($Wtable = null, $date_start = null, $date_end = null) {
        $sql = "SELECT r.*
                    FROM orders r 
                    WHERE 
                        $Wtable
                        AND LEFT(r.create_date,10) BETWEEN '$date_start' AND '$date_end' AND r.confirm = '1'";
        return \Yii::$app->db->createCommand($sql)->queryAll();
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

}
