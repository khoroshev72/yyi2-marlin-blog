<?php


namespace app\modules\admin\models;


use Yii;
use yii\base\Model;

class RegisterForm extends Model
{

    public $login;
    public $email;
    public $password;
    public $password_repeat;

    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password', 'login'], 'required'],
            ['email', 'email'],
            ['email', 'unique'],
            [['password', 'login'], 'string', 'min' => 3],
            ['password', 'compare'],
        ];
    }

    public function sendVerifyEmail($user){
        Yii::$app->mailer->compose('email_verify', compact('user'))
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setTo($user->email)
            ->setSubject('Email Confirmation')
            ->send();
    }


}