<?php

namespace thienhungho\UserManagement\migrations;

use yii\db\Schema;

class m181102_120101_user extends \yii\db\Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string(255)->notNull(),
            'password_reset_token' => $this->string(255),
            'email' => $this->string(255)->notNull(),
            'full_name' => $this->string(255),
            'job' => $this->string(255),
            'bio' => $this->text(),
            'company' => $this->string(255),
            'tax_number' => $this->string(255),
            'address' => $this->string(255),
            'avatar' => $this->string(255),
            'phone' => $this->string(255),
            'birth_date' => $this->date(),
            'facebook_url' => $this->string(255),
            'status' => $this->smallInteger(6)->notNull()->defaultValue(10),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
        ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
