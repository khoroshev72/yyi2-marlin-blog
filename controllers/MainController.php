<?php


namespace app\controllers;


use app\modules\admin\models\Category;
use app\modules\admin\models\Post;
use app\modules\admin\models\Tag;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class MainController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $query = Post::find()->with('category')->where(['status' => 1])->orderBy('id DESC');
        $pages = Post::getPagination($query, 3);
        $posts = Post::getPaginationItems($query, $pages);
        $this->view->title = \Yii::$app->name;
        return $this->render('index', compact('posts', 'pages'));
    }

    public function actionSingle($slug)
    {
        $post = Post::find()->where(['slug' => $slug, 'status' => 1])->one();
        if (!$post){
            throw new NotFoundHttpException('Страница не найдена');
        }
        $this->view->title = $post->title;
        return $this->render('single', compact('post'));
    }

    public function actionCategory($slug)
    {
        $category = Category::find()->where(['slug' => $slug])->one();
        if (!$category){
            throw new NotFoundHttpException('Страница не найдена');
        }
        $query = $category->getPosts()->where(['status' => 1])->orderBy('id DESC');
        $pages = Post::getPagination($query, 2);
        $posts = Post::getPaginationItems($query, $pages);
        $this->view->title = $category->title;
        return $this->render('category', compact('posts',  'category','pages'));
    }

    public function actionTag($slug)
    {
        $tag = Tag::find()->where(['slug' => $slug])->one();
        if (!$tag){
            throw new NotFoundHttpException('Страница не найдена');
        }
        $query = $tag->getPosts()->with('category')->where(['status' => 1])->orderBy('id DESC');
        $pages = Post::getPagination($query, 2);
        $posts = Post::getPaginationItems($query, $pages);
        $this->view->title = $tag->title;
        return $this->render('tag', compact('posts',  'pages'));
    }
}