<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post_tag}}`.
 */
class m201115_133359_create_post_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post_tag}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer(),
            'tag_id' => $this->integer()
        ]);

        $this->createIndex(
            'idx-post_tag-post_id',
            'post_tag',
            'post_id'
        );

        $this->addForeignKey(
            'fk-post_tag-post_id',
            'post_tag',
            'post_id',
            'post',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex(
            'idx-post_tag-user_id',
            'post_tag',
            'tag_id'
        );

        $this->addForeignKey(
            'fk-post_tag-tag_id',
            'post_tag',
            'tag_id',
            'tag',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-post_tag-post_id',
            'post_tag'
        );

        $this->dropForeignKey(
            'fk-post_tag-post_id',
            'post_tag'
        );

        $this->dropIndex(
            'idx-post_tag-tag_id',
            'post_tag'
        );

        $this->dropForeignKey(
            'fk-post_tag-tag_id',
            'post_tag'
        );

        $this->dropTable('{{%post_tag}}');
    }
}
