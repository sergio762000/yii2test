<?php

use yii\db\Migration;

/**
 * Class m230212_130623_add_column_deleted_post
 */
class m230212_130623_add_column_deleted_post extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%post}}', 'is_deleted', $this->boolean()->defaultValue(false));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230212_130623_add_column_deleted_post cannot be reverted.\n";

        return false;
    }

}
