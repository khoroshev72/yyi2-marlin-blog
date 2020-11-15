<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post}}`.
 */
class m201115_120947_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'user_id' => $this->integer(),
            'status' => $this->boolean()->defaultValue(1),
            'title' => $this->string()->notNull(),
            'slug' => $this->string()->notNull()->unique(),
            'description' => $this->text()->notNull(),
            'content' => $this->text()->notNull(),
            'views' => $this->integer()->unsigned()->defaultValue(0),
            'img' => $this->string(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);

        $this->createIndex(
            'idx-post-category_id',
            'post',
            'category_id'
        );

        $this->addForeignKey(
            'fk-post-category_id',
            'post',
            'category_id',
            'category',
            'id',
            'SET NULL',
            'CASCADE'
        );


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-post-category_id',
            'post'
        );

        $this->dropIndex(
            'idx-post-category_id',
            'post'
        );
        $this->dropTable('{{%post}}');
    }
}
