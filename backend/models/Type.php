<?php

namespace app\models;

use Yii;
use \yii\web\UploadedFile;
/**
 * This is the model class for table "type".
 *
 * @property integer $id
 * @property string $typename
 */
class Type extends \yii\db\ActiveRecord {

    public $upload_foler = 'uploads';

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'type';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['typename', 'active'], 'required'],
            [['typename'], 'string', 'max' => 255],
            [['active'], 'integer'],
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
            'typename' => 'ประเภทอาหาร / เครื่องดื่ม',
            'images' => 'รูปภาพ',
            'active' => 'Active',
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

}
