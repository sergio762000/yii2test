<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%image_post}}`.
 */
class m230214_155847_create_image_post_table extends Migration
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

        $this->createTable('{{%image_post}}', [
            'image_id' => $this->integer()->notNull(),
            'post_id' =>$this->integer()->notNull(),
        ]);

        $this->createIndex('idx-image-post', '{{%image_post}}', ['image_id', 'post_id']);
        $this->addForeignKey('fk-image_id', '{{%image_post}}', 'image_id', '{{%image}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-post_id', '{{%image_post}}', 'post_id', '{{%post}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%image_post}}');
    }
}
