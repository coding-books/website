<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string $slug
 * @property string $language_code
 * @property string $title
 * @property string $description
 * @property string $download_link
 * @property int $views
 *
 * @property BooksCategories[] $booksCategories
 * @property BooksLinks[] $booksLinks
 * @property BooksPhotos[] $booksPhotos
 * @property BooksViews[] $booksViews
 */
class Books extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slug', 'language_code'], 'required'],
            [['title', 'description', 'download_link'], 'string'],
            [['views'], 'integer'],
            [['slug'], 'string', 'max' => 255],
            [['language_code'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => 'Slug',
            'language_code' => 'Language Code',
            'title' => 'Title',
            'description' => 'Description',
            'download_link' => 'Download Link',
            'views' => 'Views',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooksCategories()
    {
        return $this->hasMany(BooksCategories::className(), ['book_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooksLinks()
    {
        return $this->hasMany(BooksLinks::className(), ['book_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooksPhotos()
    {
        return $this->hasMany(BooksPhotos::className(), ['book_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooksViews()
    {
        return $this->hasMany(BooksViews::className(), ['book_id' => 'id']);
    }
}
