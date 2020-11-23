<?php

use app\components\SidebarWidget;
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>

<div class="row">
    <div class="col-md-8">
        <? if ($posts): ?>
        <div class="row">
            <? foreach ($posts as $post): ?>
                <div class="col-md-6">
                <article class="post post-grid">
                    <div class="post-thumb">
                        <a href="<?=Url::to(['main/single', 'slug' => $post->slug]) ?>"><img src="<?=$post->getImage() ?>" alt="<?=$post->title ?>"></a>

                        <a href="<?=Url::to(['main/single', 'slug' => $post->slug]) ?>" class="post-thumb-overlay text-center">
                            <div class="text-uppercase text-center">View Post</div>
                        </a>
                    </div>
                    <div class="post-content">
                        <header class="entry-header text-center text-uppercase">
                            <h6><a href="<?=Url::to(['main/category', 'slug' => $category->slug]) ?>"> <?=$category->title ?></a></h6>

                            <h1 class="entry-title"><a href="<?=Url::to(['main/single', 'slug' => $post->slug]) ?>"><?=$post->title ?></a></h1>


                        </header>
                        <div class="entry-content">
                            <p><?=$post->description ?></p>

                            <div class="social-share">
                                <span class="social-share-title pull-left text-capitalize">By Rubel On <?=Yii::$app->formatter->asDate($post->created_at, 'php:F d, Y') ?></span>
                            </div>
                        </div>
                    </div>

                </article>
            </div>
            <? endforeach; ?>
        </div>
        <?=LinkPager::widget([
            'pagination' => $pages
        ]) ?>
        <? else: ?>
            <p>Не найдено ни одного поста...</p>
        <? endif; ?>
    </div>
    <?= SidebarWidget::widget()?>
</div>
