<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Посты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>

        <a href="<?=Url::to(['post/upload', 'id' => $model->id]) ?>" class="btn btn-default">Загрузить картинку</a>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                    'attribute' => 'category_id',
                    'value' => function($data){
                        return $data->category->title;
                    }
            ],
            'user_id',
            [
                'attribute' => 'status',
                'value' => function($data){
                    return $data->status ? 'Активен' : 'Бан';
                }
            ],
            'title',
//            'slug',
            'description:ntext',
            'content:ntext',
            'views',
            [
                'attribute' => 'category_id',
                'value' => function($data){
                    return  '<img src="'. $data->getImage() .'" width="200" class="img-thumbnail">';
                },
                'format' => 'html',
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
