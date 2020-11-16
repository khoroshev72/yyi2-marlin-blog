<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Посты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить пост', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>'',
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                    'attribute' => 'category_id',
                    'value' => function($data){
                        return '<a href="' . \yii\helpers\Url::to(['/admin/category/view', 'id' => $data->category->id]) . '">' . $data->category->title . '</a>';
                    },
                    'format' => 'raw',

            ],
//            'user_id',
            [
                    'attribute' => 'status',
                    'value' => function($data){
                        return $data->status ? 'Активный' : 'Бан';
                    },
                    'format' => 'raw'
            ],
            'title',
            //'slug',
            //'description:ntext',
            //'content:ntext',
            'views',
            //'img',
            'created_at:datetime',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
