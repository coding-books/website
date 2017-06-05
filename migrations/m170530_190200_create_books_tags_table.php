<?php

use yii\db\Migration;

/**
 * Handles the creation of table `books_tags`.
 */
class m170530_190200_create_books_tags_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up(){
        $this->createTable('books_tags', [
            'id'            =>  $this->primaryKey()->unsigned(),
            'tag'           =>  $this->string(64)->notNull(),
        ]);

        $this->createTable('books_tags_ref', [
            'book_id'       =>  $this->integer()->notNull()->unsigned(),
            'tag_id'        =>  $this->integer()->notNull()->unsigned()
        ]);

        $this->addForeignKey('books_tags_ref-book_id-books-id', 'books_tags_ref', 'book_id', 'books', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down(){
        $this->dropForeignKey('books_tags_ref-book_id-books-id', 'books_tags_ref');
        $this->dropTable('books_tags_ref');
        $this->dropTable('books_tags');
    }
}
