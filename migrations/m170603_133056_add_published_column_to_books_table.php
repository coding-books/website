<?php

use yii\db\Migration;

/**
 * Handles adding published to table `books`.
 */
class m170603_133056_add_published_column_to_books_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('books', 'published', 'tinyint(1) DEFAULT 0');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('books', 'published');
    }
}
