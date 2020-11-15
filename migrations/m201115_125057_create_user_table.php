<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m201115_125057_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'login' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'password' => $this->string()->notNull(),
            'verified_at' => $this->dateTime(),
            'token' => $this->string()
        ]);

        $this->createIndex(
            'idx-post-user_id',
            'post',
            'user_id'
        );

        $this->addForeignKey(
            'fk-post-user_id',
            'post',
            'user_id',
            'user',
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
            'fk-post-user_id',
            'post'
        );

        $this->dropIndex(
            'idx-post-user_id',
            'post'
        );

        $this->dropTable('{{%user}}');
    }
}
