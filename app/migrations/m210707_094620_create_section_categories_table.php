<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%section_categories}}`.
 */
class m210707_094620_create_section_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%section_categories}}', [
            'id' => $this->primaryKey(),
            'name'          => $this->string()->notNull(),
            'short_name'    => $this->string(16),
            'creator_id'    => $this->integer()->notNull()->defaultValue(0),
            'created_at'    => $this->timestamp()->defaultExpression('NOW()'),
            'updated_at'    => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE NOW()'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%section_categories}}');
    }
}
