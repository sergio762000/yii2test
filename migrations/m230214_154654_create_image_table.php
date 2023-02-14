<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%image}}`.
 */
class m230214_154654_create_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%image}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(64)->notNull(),
            'filename' => $this->string(100)->notNull(),
            'uploaded_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%image}}');
    }
}
