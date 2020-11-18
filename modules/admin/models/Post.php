<?php

namespace app\modules\admin\models;

use app\models\Tag;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property int|null $category_id
 * @property int|null $user_id
 * @property int|null $status
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $content
 * @property int|null $views
 * @property string|null $img
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Comment[] $comments
 * @property Category $category
 * @property User $user
 * @property PostTag[] $postTags
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    public $status = true;

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
                'slugAttribute' => 'slug',
            ],
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'user_id', 'status', 'views'], 'integer'],
            [['title', 'description', 'content', 'category_id'], 'required'],
            [['description', 'content'], 'string'],
            [['created_at', 'updated_at', 'slug'], 'safe'],
            [['title', 'img'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Категория',
            'user_id' => 'Пользователь',
            'status' => 'Статус',
            'title' => 'Наименование',
            'description' => 'Описание',
            'content' => 'Контент',
            'views' => 'Просмотры',
            'img' => 'Изображение',
            'created_at' => 'Дата',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['post_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Gets query for [[PostTags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])->viaTable('post_tag', ['post_id' => 'id']);
    }

    public function getImage()
    {
        return $this->img ? '/uploads/' . $this->img : '/default.jpg';
    }

    public function beforeDelete()
    {
        if (!parent::beforeDelete()){
            return false;
        }
        if ($this->img){
            unlink('uploads/' . $this->img);
        }
        return true;
    }
}
