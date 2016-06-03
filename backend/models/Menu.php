<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property string $menu
 * @property integer $category
 * @property string $create_date
 */
class Menu extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['type', 'menu', 'price'], 'required'],
            [['type'], 'integer'],
            [['price'], 'number', 'numberPattern' => '/^\s*[+]?[0-9]*[.,]?[0-9]+([eE][+]?[0-9]+)?\s*$/'],
            [['create_date'], 'safe'],
            [['menu'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'menu' => 'ชื่อเมนู',
            'type' => 'ประเภท',
            'create_date' => 'วันที่บันทึก',
        ];
    }

}
