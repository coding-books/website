<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books_tags_ref".
 *
 * @property int $book_id
 * @property int $tag_id
 *
 * @property Books $book
 * @property BooksTags $book0
 */
class BooksTagsRef extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books_tags_ref';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['book_id', 'tag_id'], 'required'],
            [['book_id', 'tag_id'], 'integer'],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Books::className(), 'targetAttribute' => ['book_id' => 'id']],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => BooksTags::className(), 'targetAttribute' => ['book_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'book_id' => 'Book ID',
            'tag_id' => 'Tag ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Books::className(), ['id' => 'book_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook0()
    {
        return $this->hasOne(BooksTags::className(), ['id' => 'book_id']);
    }
}
