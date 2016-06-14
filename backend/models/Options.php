<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "options".
 *
 * @property integer $id
 * @property integer $menu
 * @property string $options
 * @property string $create_date
 * @property integer $price
 */
class Options extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'options';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['menu', 'price'], 'integer'],
            [['create_date'], 'safe'],
            [['options'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'menu' => 'เมนู',
            'options' => 'Options',
            'create_date' => 'วันที่บันทึก',
            'price' => 'ราคา',
        ];
    }

    public function Getdata($orderID = null, $menu = null, $orderlist_id = null) {
        $sql = "SELECT o.*,m.`options` AS optionsname,m.price
                    FROM `options` o INNER JOIN  menuoptions m
                    ON o.options_id = m.id
                    WHERE o.order_id = '$orderID'
                    AND o.menu = '$menu'
                    AND o.orderlist_id = '$orderlist_id' ";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

}
