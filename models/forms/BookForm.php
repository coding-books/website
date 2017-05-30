<?php
/**
 * Created by PhpStorm.
 * User: bobroid
 * Date: 5/28/17
 * Time: 11:09 PM
 */

namespace app\models\forms;


use app\models\Books;
use app\models\BooksPhotos;
use yii\base\Model;
use yii\helpers\BaseInflector;
use yii\helpers\StringHelper;
use yii\web\UploadedFile;

class BookForm extends Model
{

    public $id;

    public $slug;

    public $language_code;

    public $title;

    public $description;

    public $download_link;

    public $categories;

    public $photos;

    /**
     * @var UploadedFile
     */
    public $book_file;

    /**
     * @var UploadedFile[]
     */
    public $photos_files;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['slug', 'language_code', 'title', 'description', 'download_link'], 'string'],
            [['language_code', 'title', 'description', 'book_file'], 'required'],
            [['categories', 'photos'], 'safe'],
            [['book_file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'epub, pdf'],
            //[['photos_files'], 'file', 'extensions' => 'png, jpg']
        ];
    }

    public function init()
    {
        $this->language_code = \Yii::$app->language;

        parent::init(); // TODO: Change the autogenerated stub
    }

    public function load($data, $formName = null)
    {
        $loaded = parent::load($data, $formName);

        if($loaded){
            $this->book_file = UploadedFile::getInstance($this, 'book_file');
            $this->photos_files = UploadedFile::getInstances($this, 'photos_files');
        }

        return $loaded;
    }

    public function save(){
        $bookName = preg_replace('/\s+/', '_', StringHelper::truncate(BaseInflector::transliterate($this->title), 40, false));

        $savedPhotos = [];
        $id = time().'_'.StringHelper::truncate(md5(time()), 10, false);
        $newBookName = \Yii::$app->params['books_dir'].DIRECTORY_SEPARATOR.$bookName.$id.'-'.$this->language_code.'.'.$this->book_file->extension;

        if($this->book_file->saveAs(\Yii::getAlias('@webroot').$newBookName)){
            $this->download_link = $newBookName;
        }else{
            $this->addError('book_file', \Yii::t('errors', 'Error with file uploading!'));
            return false;
        }

        if(!empty($this->photos_files)){
            if(is_dir(\Yii::getAlias('@webroot').\Yii::$app->params['photos_dir'].DIRECTORY_SEPARATOR.$bookName.DIRECTORY_SEPARATOR) == false){
                mkdir(\Yii::getAlias('@webroot').\Yii::$app->params['photos_dir'].DIRECTORY_SEPARATOR.$bookName.DIRECTORY_SEPARATOR);
            }

            foreach($this->photos_files as $id => $photo_file){
                $id = time().'_'.StringHelper::truncate(md5($id), 10);
                $photo_name = \Yii::$app->params['photos_dir'].DIRECTORY_SEPARATOR.$bookName.DIRECTORY_SEPARATOR.$bookName.'-'.$this->language_code.'-'.$id.'.'.$photo_file->extension;
                if($photo_file->saveAs(\Yii::getAlias('@webroot').$photo_name)){
                    $savedPhotos[] = $photo_name;
                }
            }
        }

        $this->slug = $bookName;

        $book = new Books($this->getAttributes(null, ['categories', 'photos', 'book_file', 'photos_files']));
        $book->creator_id = \Yii::$app->user->id;

        if($book->save()){
            foreach($savedPhotos as $photo){
                $bookPhoto = new BooksPhotos([
                    'book_id'       =>  $book->id,
                    'language_code' =>  $this->language_code,
                    'src'           =>  $photo
                ]);

                $bookPhoto->save();
            }

            return true;
        }

        return false;
    }

    public function getLanguageCodes(){
        return ['en' => 'en', 'ru' => 'ru', 'uk' => 'uk'];
    }

}