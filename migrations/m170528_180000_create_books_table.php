<?php

use yii\db\Migration;

/**
 * Handles the creation of table `books`.
 */
class m170528_180000_create_books_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {

        $this->dropTable('books');
        $this->dropTable('books_links');
        $this->dropTable('books_photos');
        $this->dropTable('categories');
        $this->dropTable('books_categories');

        $this->createTable('books', [
            'id'    =>  $this->primaryKey()->unsigned(),
            'slug'  =>  $this->string()->notNull(),
        ]);

        $this->createTable('books_links', [
            'book_id'       =>  $this->integer()->unsigned()->notNull(),
            'language_code' =>  $this->string(2)->notNull(),
            'link'          =>  $this->text()->notNull()
        ]);

        $this->createTable('books_photos', [
            'book_id'       =>  $this->integer()->unsigned()->notNull(),
            'language_code' =>  $this->string(2)->defaultValue(null),
            'src'           =>  $this->text()
        ]);

        $this->createTable('categories', [
            'id'            =>  $this->primaryKey()->unsigned(),
            'slug'          =>  $this->text()->notNull(),
            'parent_id'     =>  $this->integer()->unsigned(),
        ]);

        $this->createTable('books_categories', [
            'book_id'       =>  $this->integer()->unsigned()->notNull(),
            'category_id'   =>  $this->integer()->unsigned()->notNull()
        ]);

        $this->createIndex('books-slug', 'books', 'slug');
        $this->createIndex('books_links-language_code', 'books_links', 'language_code');
        $this->createIndex('books_photos-language_code', 'books_photos', 'language_code');
        $this->createIndex('categories-slug', 'categories', 'slug');
        $this->createIndex('categories-parent_id', 'categories', 'parent_id');

        $this->addForeignKey('fk-books_links-book_id-books-id', 'books_links', 'book_id', 'books', 'id');
        $this->addForeignKey('fk-books_photos-book_id-books-id', 'books_photos', 'book_id', 'books', 'id');
        $this->addForeignKey('fk-books_categories-book_id-books-id', 'books_categories', 'book_id', 'books', 'id');
        $this->addForeignKey('fk-books_categories-category_id-categories-id', 'books_categories', 'category_id', 'categories', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-books_links-book_id-books-id', 'books_links');
        $this->dropForeignKey('fk-books_photos-book_id-books-id', 'books_photos');
        $this->dropForeignKey('fk-books_categories-book_id-books-id', 'books_categories');
        $this->dropForeignKey('fk-books_categories-category_id-categories-id', 'books_categories');

        $this->dropTable('books');
        $this->dropTable('books_links');
        $this->dropTable('books_photos');
        $this->dropTable('categories');
        $this->dropTable('books_categories');
    }
}
