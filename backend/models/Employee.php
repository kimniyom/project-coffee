<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property integer $id
 * @property string $name
 * @property string $lname
 * @property string $username
 * @property string $password
 * @property string $resgister
 * @property integer $salary
 * @property string $status
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'lname', 'username','password','resgister','status'],'required'],
            [['resgister'], 'safe'],
            [['salary'], 'integer'],
            [['status'], 'string'],
            [['name', 'lname', 'username'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อ',
            'lname' => 'นามสกุล',
            'username' => 'Username',
            'password' => 'Password',
            'resgister' => 'วันที่เข้าทำงาน',
            'salary' => 'เงินเดือน',
            'status' => 'A = admin M = Employee',
        ];
    }
}
