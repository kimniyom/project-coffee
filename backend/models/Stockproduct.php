<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stockproduct".
 *
 * @property integer $id
 * @property string $productname
 * @property integer $category
 * @property integer $unit
 * @property integer $number
 * @property string $create_date
 */
class Stockproduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stockproduct';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productname','category','unit'],'required'],
            [['category','unit'], 'integer'],
            [['create_date'], 'safe'],
            [['productname'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัส',
            'productname' => 'ชื่อสินค้า',
            'category' => 'หมวด',
            'unit' => 'หน่วยนับ',
            'create_date' => 'วันที่นำเข้า',
        ];
    }
}
