<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mix".
 *
 * @property integer $id
 * @property integer $menu
 * @property integer $product_stock_id
 * @property integer $number
 * @property string $create_date
 * @property integer $category
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
            [['menu', 'product_stock_id', 'number', 'category'], 'integer'],
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
            'menu' => 'Menu',
            'product_stock_id' => 'Product Stock ID',
            'number' => 'Number',
            'create_date' => 'Create Date',
            'category' => 'Category',
        ];
    }
}
