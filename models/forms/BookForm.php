<?php
/**
 * Created by PhpStorm.
 * User: bobroid
 * Date: 5/28/17
 * Time: 11:09 PM
 */

namespace app\models\forms;


use yii\base\Model;

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

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['slug', 'language_code', 'title', 'description', 'download_link'], 'string'],
            [['categories', 'photos'], 'safe']
        ];
    }

    public function save(){

    }

}