<?php


namespace app\controllers;


use app\modules\admin\models\LoginForm;
use app\modules\admin\models\RegisterForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;
use app\modules\admin\models\User;

class UserController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['login', 'logout', 'register'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'register'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }

        $this->view->title = 'Вход';
        return $this->render('login', compact('model'));
    }

    public function actionRegister()
    {
        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post()) && $user = User::saveNewUser($model)){
            $model->sendVerifyEmail($user);
            Yii::$app->session->setFlash('success', 'Для заверешения процедуры регистрации проверьте вашу почту и подтвердите ваш email по ссылке в письме');
            return $this->goHome();
        }
        $this->view->title = 'Регистрация';
        return $this->render('register', compact('model'));
    }

    public function actionVerify($token)
    {
        $user = User::ifTokenExists($token);
        $user->verified_at = date('Y-m-d h:i:s', time());
        $user->token = null;
        if ($user->save()){
            Yii::$app->user->login($user);
            Yii::$app->session->setFlash('success', 'Вы успешно зарегистрировались');
        } else {
            Yii::$app->session->setFlash('danger', 'Ошибка регистрации');
        }
        return $this->goHome();
    }

    public function actionLogout()
    {
        User::registerLogoutHook();
        Yii::$app->user->logout();
        return $this->goHome();
    }

}