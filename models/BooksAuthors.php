<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books_authors".
 *
 * @property int $id
 * @property string $name
 *
 * @property BooksAuthorsRef[] $booksAuthorsRefs
 */
class BooksAuthors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books_authors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('models','Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooksAuthorsRefs()
    {
        return $this->hasMany(BooksAuthorsRef::className(), ['book_author_id' => 'id']);
    }
}
