<?php


namespace app\components;
use app\modules\admin\models\Category;
use app\modules\admin\models\Post;
use yii\base\Widget;

class SidebarWidget extends Widget
{
    public $categories;
    public $popularPosts;
    public $recentPosts;

    public function init()
    {
        $this->categories = Category::find()->all();
        $this->popularPosts = Post::getPopularPosts();
        $this->recentPosts = Post::getRecentPosts();
    }

    public function run()
    {
        $categories = $this->categories;
        $popularPosts = $this->popularPosts;
        $recentPosts = $this->recentPosts;
        return $this->render('sidebar', compact('categories', 'popularPosts', 'recentPosts'));

    }

}