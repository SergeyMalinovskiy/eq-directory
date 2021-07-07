<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sections}}`.
 */
class m210706_104932_create_sections_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sections}}', [
            'id'                    => $this->primaryKey(),
            'pid'                   => $this->integer()->defaultValue(0),
            'name'                  => $this->string(64),
            'creator_id'            => $this->integer()->notNull()->defaultValue(0),
            'category_id'           => $this->integer()->defaultValue(0),
            'responsible_group_id'  => $this->integer()->defaultValue(0),
            'created_at'            => $this->timestamp()->defaultExpression('NOW()'),
            'updated_at'            => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE NOW()'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%sections}}');
    }
}
