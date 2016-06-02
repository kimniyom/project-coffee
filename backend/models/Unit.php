<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "unit".
 *
 * @property integer $id
 * @property string $unit
 */
class Unit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['unit'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'unit' => 'หน่วยนับ',
        ];
    }
}
