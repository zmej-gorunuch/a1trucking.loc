<?php

use yii\db\Migration;

/**
 * Class m181008_115232_statistic
 */
class m181008_115232_statistic extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('statistic', [
            'id' => $this->primaryKey(),
            'ip' => $this->string(15)->notNull(),
            'url' => $this->string(255),
            'country' => $this->string(255),
            'device' => $this->string(255),
            'count_views' => $this->integer(),
            'date' => $this->integer(),
            'black_list_ip' => $this->boolean()->defaultValue(0)->notNull(),
        ]);
//        $this->addForeignKey('назва функції звязування', 'поточна таблиця', 'колонка поточної таблиці', 'назва звязуваної таблиці', 'колонка звязуваної таблиці');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('statistic');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181008_115217_settings cannot be reverted.\n";

        return false;
    }
    */
}
