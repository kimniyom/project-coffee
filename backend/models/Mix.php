<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mix".
 *
 * @property integer $id
 * @property integer $menu
 * @property integer $product_stock_id
 * @property string $create_date
 */
class Mix extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mix';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu', 'product_stock_id','number'], 'required'],
            [['menu', 'product_stock_id','number'], 'integer'],
            [['create_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'menu' => 'เมนู',
            'product_stock_id' => 'รหัสส่วนผสม',
            'number' => 'จำนวน',
            'create_date' => 'วันที่บันทึก',
        ];
    }
}
