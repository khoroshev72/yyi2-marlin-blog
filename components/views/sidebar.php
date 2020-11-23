<?
use yii\helpers\Url;
?>

<div class="col-md-4" data-sticky_column>
    <div class="primary-sidebar">
        <!--        categories-->
        <aside class="widget border pos-padding">
            <h3 class="widget-title text-uppercase text-center">Categories</h3>
            <ul>
                <? foreach ($categories as $category): ?>
                <li>
                    <a href="<?=Url::to(['main/category', 'slug' => $category->slug]) ?>"><?=$category->title ?></a>
                    <span class="post-count pull-right"> (<?=$category->getPosts()->count() ?>)</span>
                </li>
                <? endforeach; ?>
            </ul>
        </aside>
        <!--        popular-->
        <aside class="widget">
            <h3 class="widget-title text-uppercase text-center">Popular Posts</h3>
            <? foreach ($popularPosts as $post): ?>
                <div class="popular-post">
                <a href="<?=Url::to(['main/single', 'slug' => $post->slug]) ?>" class="popular-img"><img src="<?=$post->getImage() ?>" alt="<?=$post->title ?> width="200">
                    <div class="p-overlay"></div>
                </a>
                <div class="p-content">
                    <a href="<?=$post->getImage() ?>" class="text-uppercase"><?=$post->title ?></a>
                    <span class="p-date"><?=Yii::$app->formatter->asDate($post->created_at, 'php: F d, Y') ?></span>
                </div>
            </div>
            <? endforeach; ?>

        </aside>
        <!--        recent-->
        <aside class="widget pos-padding">
            <h3 class="widget-title text-uppercase text-center">Recent Posts</h3>
            <? foreach ($recentPosts as $post): ?>
                <div class="thumb-latest-posts">
                    <div class="media">
                    <div class="media-left">
                        <a href="<?=Url::to(['main/single', 'slug' => $post->slug]) ?>" class="popular-img"><img src="<?=$post->getImage() ?>" alt="<?=$post->title ?>">
                            <div class="p-overlay"></div>
                        </a>
                    </div>
                    <div class="p-content">
                        <a href="<?=Url::to(['main/single', 'slug' => $post->slug]) ?>" class="text-uppercase"><?=$post->title ?></a>
                        <span class="p-date"><?=Yii::$app->formatter->asDate($post->created_at, 'php: F d, Y') ?></span>
                    </div>
                </div>
                </div>
            <? endforeach; ?>
        </aside>
    </div>
</div>

