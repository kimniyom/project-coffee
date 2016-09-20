<?php

namespace app\models;

use Yii;
use \yii\web\UploadedFile;

/**
 * This is the model class for table "setting".
 *
 * @property integer $id
 * @property string $shopname
 * @property string $defaulttable
 * @property string $logo
 * @property string $wifi
 */
class Setting extends \yii\db\ActiveRecord {

    public $upload_foler = 'uploads';

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'setting';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['shopname', 'wifi', 'defaulttable'], 'required'],
            [['defaulttable'], 'string'],
            [['shopname', 'wifi'], 'string', 'max' => 100],
            [['logo'], 'file',
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
            'shopname' => 'ชื่อร้าน',
            'defaulttable' => 'รูปแบบการขาย',
            'logo' => 'logo',
            'wifi' => 'รหัส wifi',
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
        return empty($this->logo) ? Yii::getAlias('@web') . '/img/none.png' : $this->getUploadUrl() . $this->logo;
    }

    public function deleteimages($images = null) {
        //$url = Yii::getAlias('@web') . '/' . $this->upload_foler . '/';
        if (!empty($images)) {
            unlink("./uploads/" . $images);
        }
    }

}
