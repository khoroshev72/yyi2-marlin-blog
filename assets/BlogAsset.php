<?php


namespace app\assets;


use yii\web\AssetBundle;

class BlogAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'blog/css/bootstrap.min.css',
        'blog/css/font-awesome.min.css',
        'blog/css/animate.min.css',
        'blog/css/owl.carousel.css',
        'blog/css/owl.theme.css',
        'blog/css/owl.transitions.css',
        'blog/css/style.css',
        'blog/css/responsive.css',
    ];
    public $js = [
//        'blog/js/jquery-1.11.3.min.js',
        'blog/js/bootstrap.min.js',
        'blog/js/owl.carousel.min.js',
        'blog/js/jquery.stickit.min.js',
        'blog/js/menu.js',
        'blog/js/scripts.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];

}