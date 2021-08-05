<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m210713_082559_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp() // Действие при создании
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id'                   => $this->primaryKey(),                               // id пользователя    | первичный ключ
            'created_at'           => $this->integer()->notNull(),                       //                    | целое число, обязательное заполнение
            'updated_at'           => $this->integer()->notNull(),                       //                    | целое число, обязательное заполнение
            'username'             => $this->string()->notNull(),                        // имя пользователя   | Строка, обязательное заполнение
            'auth_key'             => $this->string(32),                           //                    | Строка, 32 символа
            'email_confirm_token'  => $this->string(),                                   //                    | Строка
            'password_hash'        => $this->string()->notNull(),                        // хешированый пароль | Строка, обязательное заполнение
            'password_reset_token' => $this->string(),                                   //                    | Строка
            'email'                => $this->string()->notNull(),                        // Email              | Строка, обязательное заполнение
            'status'               => $this->smallInteger()->notNull()->defaultValue(0), // статус             | малое целое число, обязательное заполнение, значение по умолчанию 0
        ], $tableOptions);

        $this->createIndex('idx-user-username', '{{%user}}', 'username', true);
        $this->createIndex('idx-user-email', '{{%user}}', 'email', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() // Действие при удалении
    {
        $this->dropTable('{{%user}}');
    }
}
