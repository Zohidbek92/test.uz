<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%new}}`.
 */
class m210217_144949_create_new_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%new}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%new}}');
    }
}
