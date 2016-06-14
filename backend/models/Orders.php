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
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'tables', 'confirm', 'total', 'distcount'], 'integer'],
            [['create_date'], 'safe'],
            [['tel'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'รหัสสั่งซื้อ',
            'tables' => 'รหัสโต๊ะ',
            'create_date' => 'วันที่ทำรายการ',
            'confirm' => 'Confirm',
            'total' => 'ราคารวม',
            'tel' => 'เบอร์โทรลูกค้า',
            'distcount' => 'ส่วนลด',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderlists()
    {
        return $this->hasMany(Orderlist::className(), ['order' => 'order_id']);
    }
}
