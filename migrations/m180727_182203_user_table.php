<?php

use yii\db\Migration;

/**
 * Class m180727_182203_user_table
 */
class m180727_182203_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->createTable('user', [
			'id' => $this->primaryKey(),
			'username' => $this->string(),
			'password' => $this->string(),
			'access_token' => $this->string(),
		]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		$this->dropTable('user');
    }
}
