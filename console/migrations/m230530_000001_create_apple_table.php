<?php

use common\models\Apple;
use \yii\db\Migration;

class m230530_000001_create_apple_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // https://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%apple}}', [
            'id' => $this->primaryKey(),
            'color' => $this->string()->notNull(),
            'eat_percent' => $this->decimal(18, 2)->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'fall_at' => $this->integer(),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%apple}}');
    }
}
