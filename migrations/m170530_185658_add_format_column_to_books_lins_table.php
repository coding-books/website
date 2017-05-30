<?php

use yii\db\Migration;

/**
 * Handles adding format to table `books_lins`.
 */
class m170530_185658_add_format_column_to_books_lins_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('books', 'download_link');

        $this->addColumn('books_links', 'format', $this->string(11)->notNull());

        $this->createIndex('book_link', 'books_links', ['format', 'language_code', 'book_id']);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('books_links', 'format');
        $this->addColumn('books', 'download_link', $this->text());
    }
}
