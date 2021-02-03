<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post}}`.
 */
class m210128_034922_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'body' => $this->text(),
            'newsid' => $this->string()
        ]);
        $this->createIndex('gt_id', 'post', 'newsid');
        $this->addForeignKey('newsid', 'post', 'newsid', 'news', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%post}}');
    }
}
