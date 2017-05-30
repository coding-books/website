<?php

use yii\db\Migration;

/**
 * Handles the creation of table `books_authors`.
 */
class m170530_061319_create_books_authors_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->renameColumn('books', 'author_id', 'creator_id');

        $this->createTable('books_authors', [
            'id'        =>  $this->primaryKey()->unsigned(),
            'name'      =>  $this->text(),
        ]);

        $this->createTable('books_authors_ref', [
            'book_id'       =>  $this->integer()->unsigned()->notNull(),
            'book_author_id'=>  $this->integer()->unsigned()->notNull()
        ]);

        $this->addForeignKey('fk-books_authors_ref-book_author_id-books_authors-id', 'books_authors_ref', 'book_author_id', 'books_authors', 'id');
        $this->addForeignKey('fk-books_authors_ref-book_id-books-id', 'books_authors_ref', 'book_id', 'books', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->renameColumn('books', 'creator_id', 'author_id');

        $this->dropForeignKey('fk-books_authors_ref-book_author_id-books_authors-id', 'books_authors_ref');
        $this->dropForeignKey('fk-books_authors_ref-book_id-books-id', 'books_authors_ref');

        $this->dropTable('books_authors_ref');
        $this->dropTable('books_authors');
    }
}
