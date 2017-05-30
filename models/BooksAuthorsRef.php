<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books_authors_ref".
 *
 * @property int $book_id
 * @property int $book_author_id
 *
 * @property BooksAuthors $bookAuthor
 * @property Books $book
 */
class BooksAuthorsRef extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books_authors_ref';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['book_id', 'book_author_id'], 'required'],
            [['book_id', 'book_author_id'], 'integer'],
            [['book_author_id'], 'exist', 'skipOnError' => true, 'targetClass' => BooksAuthors::className(), 'targetAttribute' => ['book_author_id' => 'id']],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Books::className(), 'targetAttribute' => ['book_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'book_id' => 'Book ID',
            'book_author_id' => 'Book Author ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookAuthor()
    {
        return $this->hasOne(BooksAuthors::className(), ['id' => 'book_author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Books::className(), ['id' => 'book_id']);
    }
}
