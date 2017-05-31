<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books_tags".
 *
 * @property int $id
 * @property string $tag
 *
 * @property BooksTagsRef[] $booksTagsRefs
 */
class BooksTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag'], 'required'],
            [['tag'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tag' => Yii::t('models','Tag'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooksTagsRefs()
    {
        return $this->hasMany(BooksTagsRef::className(), ['book_id' => 'id']);
    }
}
