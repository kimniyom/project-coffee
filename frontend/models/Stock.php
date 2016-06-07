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
 * @property integer $size
 * @property integer $size_unit
 * @property integer $total_cut
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
            [['product', 'category', 'number', 'size', 'size_unit', 'total_cut'], 'integer'],
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
            'product' => 'Product',
            'category' => 'Category',
            'number' => 'Number',
            'size' => 'Size',
            'size_unit' => 'Size Unit',
            'total_cut' => 'Total Cut',
            'create_date' => 'Create Date',
        ];
    }
   
}
