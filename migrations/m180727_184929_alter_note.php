<?php

use app\models\Note;
use yii\db\Migration;

/**
 * Class m180727_184929_alter_note
 */
class m180727_184929_alter_note extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->addColumn(Note::tableName(), 'author_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(Note::tableName(), 'author_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180727_184929_alter_note cannot be reverted.\n";

        return false;
    }
    */
}
