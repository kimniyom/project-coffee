<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tables".
 *
 * @property integer $id
 * @property integer $tables
 * @property string $comment
 * @property integer $active
 */
class Tables extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tables';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tables', 'active'], 'integer'],
            [['comment'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tables' => 'Tables',
            'comment' => 'Comment',
            'active' => 'Active',
        ];
    }
}
