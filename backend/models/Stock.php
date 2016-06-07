<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stock".
 *
 * @property integer $id
 * @property integer $product
 * @property integer $category
 * @property integer $number
 * @property integer $unit_number
 * @property integer $size
 * @property integer $size_unit
 * @property string $create_date
 */
class Stock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product', 'category', 'number', 'total_cut', 'size', 'size_unit'],'required'],
            [['number'], 'number', 'numberPattern' => '/^\s*[+]?[0-9]*[.,]?[0-9]+([eE][+]?[0-9]+)?\s*$/'],
            [['product', 'category', 'number', 'total_cut', 'size', 'size_unit'], 'integer'],
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
            'product' => 'สินค้า',
            'category' => 'หมวด',
            'number' => 'จำนวน',
            'size' => 'ขนาด',
            'size_unit' => 'หน่วยนับ',
            'total_cut' => 'จำนวนที่ตัดได้ / หน่วย',
            'total' => 'คงเหลือ',
            'create_date' => 'วันที่นำเข้า',
        ];
    }
}
