<?php


namespace app\modules\admin\models;


use yii\base\Model;

class RegisterForm extends Model
{

    public $login;
    public $email;
    public $password;

    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password', 'login'], 'required'],
            ['email', 'email'],
            ['email', 'unique'],
            [['password', 'login'], 'string', 'min' => 3],
        ];
    }


}