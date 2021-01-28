<?php

use yii\db\Migration;

/**
 * Class m210128_050957_add_position_to_post_table
 */
class m210128_050957_add_position_to_post_table extends Migration
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
        echo "m210128_050957_add_position_to_post_table cannot be reverted.\n";

        return false;
    }

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('post', 'position', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('post', 'position');
        echo "m210128_050957_add_position_to_post_table cannot be reverted.\n";

        return false;
    }
    
}
