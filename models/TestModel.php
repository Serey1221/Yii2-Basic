<?php

namespace app\models;

use yii\base\Model;

class TestModel extends Model
{
    public $name;
    public $age;
    public $surname;
    public $email;

    public function attributeLabels()
    {
        return [
            'name' => 'Enter Your Name',
            'age' => 'Enter Your age',
            'surname' => 'Enter Your Surname',
            'email' => 'Enter Your Email'
        ];
    }
    public function rules()
    {
        return [
            [['name', 'surname'], 'required', 'message' => "Please enter your name"]
        ];
    }
}
