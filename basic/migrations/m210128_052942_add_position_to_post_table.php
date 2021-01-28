<?php

use yii\db\Migration;

/**
 * Class m210128_052942_add_position_to_post_table
 */
class m210128_052942_add_position_to_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210128_052942_add_position_to_post_table cannot be reverted.\n";

        return false;
    }

    
    // Use up()/down() to run migration code without a transaction.
    // 外來鍵需要索引 https://riptutorial.com/mysql/example/14179
    // 外來鍵的類型必須與參考的相同
    // 其他可能原因 https://www.itread01.com/content/1548982275.html
    public function up()
    {
        $this->addColumn('post', 'newsid2', $this->bigInteger(20));
        $this->createIndex('gt_id', 'post', 'newsid2');
        $this->addForeignKey('newsid2', 'post', 'newsid2', 'news', 'id');
    }

    public function down()
    {
        $this->dropColumn('post', 'newsid2');
        $this->dropIndex('gt_id', 'news');
        $this->dropForeignKey('newsid2', 'post');
        echo "m210128_052942_add_position_to_post_table cannot be reverted.\n";

        return false;
    }
    
}
