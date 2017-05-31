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
 * @property int $views
 * @property int $created
 * @property int $creator_id
 *
 * @property BooksCategories[] $booksCategories
 * @property BooksPhotos[] $booksPhotos
 * @property BooksViews[] $booksViews
 * @property BooksAuthors[] $authors
 * @property BooksLinks[] $booksLinks
 * @property BooksTags[] $booksTags
 * @property \dektrium\user\models\User $booksCreator
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
            [['title', 'description'], 'string'],
            [['views', 'created', 'creator_id'], 'integer'],
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
            'slug' => Yii::t('models','Slug'),
            'language_code' => Yii::t('models','Language Code'),
            'title' => Yii::t('models','Title'),
            'description' => Yii::t('models','Description'),
            'views' => Yii::t('models','Views'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooksCreator(){
        return $this->hasOne((\Yii::$app->user)::className(), ['creator_id' => 'id']);
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors(){
        return $this->hasMany(BooksAuthors::className(), ['author_id' => 'id']);
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooksLinks(){
        return $this->hasMany(BooksLinks::className(), ['book_id' => 'id']);
    }

    public function getBooksTags(){
        //return $this->hasMany(BooksTags::className(), [''])
    }

    public function beforeSave($insert)
    {
        if($this->isNewRecord){
            if(empty($this->created)){
                $this->created = time();
            }
        }

        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    /**
     * @return BooksPhotos|null
     */
    public function getMainBookPhoto(){
        if(array_key_exists(0, $this->booksPhotos)){
            return $this->booksPhotos[0];
        }

        return null;
    }

    /**
     * @return BooksLinks|mixed
     */
    public function getDownloadLinkModel(){
        $links = $this->booksLinks;

        foreach($links as $link){
            if($link->language_code == \Yii::$app->language){
                return $link;
            }
        }

        return array_shift($links);
    }

    /**
     * @return string
     */
    public function getDownloadLink(){
        if(is_null($this->getDownloadLinkModel())){
            return null;
        }
        
        return $this->getDownloadLinkModel()->link;
    }
}
