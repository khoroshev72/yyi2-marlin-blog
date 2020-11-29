<?php

use yii\db\Migration;

/**
 * Class m201129_144400_add_auth_key_to_users
 */
class m201129_144400_add_auth_key_to_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'auth_key',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropColumn('user', 'auth_key');
    }

}
