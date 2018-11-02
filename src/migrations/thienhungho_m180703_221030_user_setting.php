<?php

namespace thienhungho\migrations;

use yii\db\Migration;

/**
 * Class m180527_101519_term_relationships
 */
class mthienhungho_m180703_221030_user_setting extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_setting}}', [
            'id'         => $this->primaryKey(19),
            'user_id'    => $this->integer(19)->notNull(),
            'section'    => $this->string()->notNull(),
            'key'        => $this->string()->notNull(),
            'value'      => $this->string(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
            'created_by' => $this->integer(19),
            'updated_by' => $this->integer(19),
        ]);

        $this->createIndex(
            'idx_user_setting_section',
            '{{%user_setting}}',
            'section'
        );

        $this->createIndex(
            'idx_user_setting_key',
            '{{%user_setting}}',
            'key'
        );

        $this->addForeignKey('fk_ut_u', '{{%user_setting}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180527_101519_term_relationships cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180527_101519_term_relationships cannot be reverted.\n";

        return false;
    }
    */
}
