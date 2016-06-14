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
            'create_date' => 'วันที่ขาย'
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
    
    public function Getlistorder(){
        $sql = "SELECT o.*,m.menu AS menuname,m.price,t.typename
                    FROM orderlist o 
                    INNER JOIN menu m ON o.menu = m.id
                    INNER JOIN type t ON m.type = t.id ";
        return \Yii::$app->db->createCommand($sql)->queryAll();
    }

}
