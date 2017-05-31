<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books_links".
 *
 * @property int $book_id
 * @property string $language_code
 * @property string $link
 * @property string $format
 *
 * @property Books $book
 */
class BooksLinks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books_links';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['book_id', 'language_code', 'link', 'format'], 'required'],
            [['book_id'], 'integer'],
            [['link'], 'string'],
            [['language_code'], 'string', 'max' => 2],
            [['format'], 'string', 'max' => 11],
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
            'language_code' => Yii::t('models','Language Code'),
            'link' => Yii::t('models','Link'),
            'format' => Yii::t('models','Format'),
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
