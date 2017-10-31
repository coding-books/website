<?php

use yii\db\Migration;

/**
 * Class m171031_083116_change_schema_books_views_table
 */
class m171031_083116_change_schema_books_views_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->alterColumn('books_views', 'timestamp', 'tinytext');
        $this->alterColumn('books_views', 'ip', 'tinytext');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171031_083116_change_schema_books_views_table cannot be reverted.\n";

        return false;
    }
}
