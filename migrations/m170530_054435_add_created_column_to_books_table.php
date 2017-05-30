<?php

use yii\db\Migration;

/**
 * Handles adding created to table `books`.
 */
class m170530_054435_add_created_column_to_books_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('books',   'created', $this->integer()->unsigned()->notNull()->defaultValue(0));
        $this->addColumn('books', 'author_id', $this->integer()->unsigned()->notNull()->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('books', 'created');
        $this->dropColumn('books', 'author_id');
    }
}
