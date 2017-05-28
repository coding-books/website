<?php

use yii\db\Migration;

class m170528_201344_change_schema extends Migration
{
    public function safeUp()
    {
        $this->addColumn('books', 'language_code', $this->string(2)->notNull());
        $this->addColumn('books', 'title', $this->text());
        $this->addColumn('books', 'description', $this->text());
        $this->addColumn('books', 'download_link', $this->text());
        $this->addColumn('books', 'views', $this->integer()->unsigned()->notNull()->defaultValue(0));

        $this->createTable('books_views', [
            'book_id'       =>  $this->integer()->unsigned()->notNull(),
            'timestamp'     =>  $this->integer(),
            'ip'            =>  $this->integer(),
        ]);

        $this->addForeignKey('fk-books_views-book_id-books-id', 'books_views', 'book_id', 'books', 'id');

    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-books_views-book_id-books-id', 'books_views');

        $this->dropTable('books_views');

        $this->dropColumn('books', 'language_code');
        $this->dropColumn('books', 'title');
        $this->dropColumn('books', 'description');
        $this->dropColumn('books', 'download_link');
        $this->dropColumn('books', 'views');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170528_201344_change_schema cannot be reverted.\n";

        return false;
    }
    */
}
