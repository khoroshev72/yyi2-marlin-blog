<?php

namespace app\modules\admin;


use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    public $layout = '/admin';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'matchCallback' => function () {
                            return !\Yii::$app->user->isGuest && \Yii::$app->user->identity->isAdmin === 1;
                        },
                    ],
                    [
                        'allow' => false,
                        'denyCallback' => function () {
                            throw new NotFoundHttpException('В админку хочешь?:)');
                        },
                    ],
                ],
            ],
        ];
    }
}
