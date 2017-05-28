<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books_views".
 *
 * @property int $book_id
 * @property int $timestamp
 * @property int $ip
 *
 * @property Books $book
 */
class BooksViews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books_views';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['book_id'], 'required'],
            [['book_id', 'timestamp', 'ip'], 'integer'],
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
            'timestamp' => 'Timestamp',
            'ip' => 'Ip',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Books::className(), ['id' => 'book_id']);
    }
}
