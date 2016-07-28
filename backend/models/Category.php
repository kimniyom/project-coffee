<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $cat_name
 * @property integer $status
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_name'],'required'],
            [['status'], 'integer'],
            [['cat_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัส',
            'cat_name' => 'ประเภท',
            'status' => 'สถานะ',
        ];
    }
    
    public function getstatus($status = null){
        if($status == 1){
            return "active";
        } else {
            return "unactive";
        }
    }
}
