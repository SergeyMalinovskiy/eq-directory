<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%equipment}}`.
 */
class m210713_092745_create_equipment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%equipments}}', [
            'id'                    => $this->primaryKey(),
            'title'                 => $this->string(128)->notNull(),
            'comment'               => $this->text(),
            'serial_number'         => $this->string(64)->notNull(),
            'lan_ports_count'       => $this->integer()->defaultValue(0),
            'uplink_ports_count'    => $this->integer()->defaultValue(0),
            'mgt_ipv4_address'      => $this->integer()->unsigned(),
            'monsys_ipv4_address'   => $this->integer()->unsigned(),
            'pid'                   => $this->integer()->defaultValue(0),
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
        $this->dropTable('{{%equipments}}');
    }
}
