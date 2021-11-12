<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%article}}`.
 */
class m211112_095406_create_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%article}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'description' => $this->string(255),
            'content' => $this->string(255),
            'date' => $this->dateTime(),
            'viewed' => $this->string(11),
            'status' => $this->string(11),
            'category_id' => $this->string(11),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%article}}');
    }
}
