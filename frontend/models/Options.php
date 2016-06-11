<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "options".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $menu
 * @property string $options_id
 * @property string $create_date
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
            [['order_id', 'menu'], 'integer'],
            [['create_date'], 'safe'],
            [['options_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'order_id' => 'รหัส',
            'menu' => 'เมนู',
            'options_id' => 'Options',
            'create_date' => 'วันที่บันทึก',
        ];
    }

    public function Getdata($orderID = null, $menu = null) {
        $sql = "SELECT o.*,m.`options` AS optionsname,m.price
                    FROM `options` o INNER JOIN  menuoptions m
                    ON o.options_id = m.id
                    WHERE o.order_id = '$orderID' AND o.menu = '$menu' ";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

}
