<?php


namespace app\controllers;


use app\modules\admin\models\Post;
use yii\data\Pagination;
use yii\web\Controller;

class MainController extends Controller
{
    public function actionIndex()
    {
        $query = Post::find()->with('category')->where(['status' => 1])->orderBy('id DESC');
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'defaultPageSize' => 3,
            'forcePageParam' => false,
        ]);
        $posts = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $this->view->title = \Yii::$app->name;
        return $this->render('index', compact('posts', 'pages'));
    }
}