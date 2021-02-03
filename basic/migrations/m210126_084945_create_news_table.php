<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%news}}`.
 */
class m210126_084945_create_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%news}}', [
            'id' => $this->bigPrimaryKey(20),
            'title' => $this->string()->notNull(),
            'content' => $this->text(),
            'createAt' => $this->dateTime()->notNull(),
            'createBy' => $this->string(20)->notNull(),
            'modifyAt' => $this->dateTime(),
            'modifyBy' => $this->string(20),
            'deleteAt' => $this->dateTime(),
            'deleteBy' => $this->string(20),
            'isDelete' => $this->boolean()->defaultValue(false)->notNull(),
        ]);

        $this->insert('{{%news}}', [
            'title' => '123',
            'content' => 'ABC',
            'createAt' => '2021-01-28 11:33:31',
            'createBy' => '89'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%news}}');
    }
}
