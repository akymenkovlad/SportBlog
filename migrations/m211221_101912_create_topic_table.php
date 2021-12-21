<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%topic}}`.
 */
class m211221_101912_create_topic_table extends Migration

{

    /**
     * {@inheritdoc}
     */

    public function safeUp()

    {

        $this->createTable('{{%topic}}', [

            'id' => $this->primaryKey(),

            'name' => $this->string(),

        ]);

    }

    /**
     * {@inheritdoc}
     */

    public function safeDown()

    {

        $this->dropTable('{{%topic}}');

    }

}