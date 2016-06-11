<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menuoptions".
 *
 * @property integer $id
 * @property string $options
 * @property integer $price
 * @property string $create_date
 */
class Menuoptions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menuoptions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price'], 'integer'],
            [['create_date'], 'safe'],
            [['options'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'options' => 'รายการ',
            'price' => 'ราคา',
            'create_date' => 'วันที่บันทึก',
        ];
    }
}
