<?php

namespace app\models\book\factory;

use app\models\Books;
use app\models\BooksViews;
use Yii;

/**
 * Class BookViewsFactory
 * @package app\models\book\factory
 */
class BookViewsFactory
{
    /**
     * @param Books $book
     * @return BooksViews
     */
    public static function build (Books $book) : BooksViews {
        $bookView = new BooksViews();

        $bookView->book_id = $book->id;
        $bookView->ip = Yii::$app->getRequest()->getUserIP();

        $bookView->save();

        return $bookView;
    }
}