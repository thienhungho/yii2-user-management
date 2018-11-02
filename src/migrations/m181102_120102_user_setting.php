<?php

namespace thienhungho\UserManagement\migrations;

use yii\db\Schema;

class m181102_120102_user_setting extends \yii\db\Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%user_setting}}', [
            'id'         => $this->primaryKey(),
            'user_id'    => $this->integer(19)->notNull(),
            'section'    => $this->string(255)->notNull(),
            'key'        => $this->string(255)->notNull(),
            'value'      => $this->string(255),
            'created_at' => $this->timestamp()->notNull()->defaultValue(CURRENT_TIMESTAMP),
            'updated_at' => $this->timestamp()->notNull()->defaultValue('0000-00-00 00:00:00'),
            'created_by' => $this->integer(19),
            'updated_by' => $this->integer(19),
            'FOREIGN KEY ([[user_id]]) REFERENCES {{%user}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%user_setting}}');
    }
}
