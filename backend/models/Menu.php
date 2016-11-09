<?php

namespace app\models;

use Yii;
use \yii\web\UploadedFile;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property string $menu
 * @property integer $category
 * @property string $create_date
 */
class Menu extends \yii\db\ActiveRecord {

    public $upload_foler = 'uploads';

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
            [['type', 'menu', 'price', 'unit'], 'required'],
            [['type', 'unit', 'mix'], 'integer'],
            [['price'], 'number', 'numberPattern' => '/^\s*[+]?[0-9]*[.,]?[0-9]+([eE][+]?[0-9]+)?\s*$/'],
            [['create_date'], 'safe'],
            [['menu'], 'string', 'max' => 255],
            [['images'], 'file',
                'skipOnEmpty' => true,
                'extensions' => 'png,jpg'
            ]
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
            'price' => 'ราคา',
            'mix' => 'ส่วนผสม',
            'unit' => 'หน่วย',
            'create_date' => 'วันที่บันทึก',
        ];
    }

    public function upload($model, $attribute) {
        $photo = UploadedFile::getInstance($model, $attribute);
        $path = $this->getUploadPath();
        if ($this->validate() && $photo !== null) {

            $fileName = md5($photo->baseName . time()) . '.' . $photo->extension;
            //$fileName = $photo->baseName . '.' . $photo->extension;
            if ($photo->saveAs($path . $fileName)) {
                return $fileName;
            }
        }
        return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
    }

    public function getUploadPath() {
        return Yii::getAlias('@webroot') . '/' . $this->upload_foler . '/';
    }

    public function getUploadUrl() {
        return Yii::getAlias('@web') . '/' . $this->upload_foler . '/';
    }

    public function getPhotoViewer() {
        return empty($this->images) ? Yii::getAlias('@web') . '/img/none.png' : $this->getUploadUrl() . $this->images;
    }

    public function deleteimages($images = null) {
        //$url = Yii::getAlias('@web') . '/' . $this->upload_foler . '/';
        if (!empty($images)) {
            unlink("./uploads/" . $images);
        }
    }

    public function CheckCub($menuid = null) {
        $sql = "SELECT IFNULL((ROUND(Q1.total/x.number,0)),0) AS CUB
            FROM menu m INNER JOIN mix x ON m.id = x.menu

            INNER JOIN 

            (
               SELECT s.product,SUM(s.total) AS total 
               FROM stock s 
               WHERE s.total > 0 
               GROUP BY s.product
            ) Q1

            ON x.product_stock_id = Q1.product


            WHERE m.id = '$menuid'
            ORDER BY CUB ASC 
            LIMIT 1 ";

        $rs = \Yii::$app->db->createCommand($sql)->queryOne();
        return $rs['CUB'];
    }

}
