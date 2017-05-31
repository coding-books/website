<?php

namespace app\controllers;

use app\models\Books;
use app\models\BooksCategories;
use app\models\BooksTags;
use app\models\Categories;
use app\models\forms\BookForm;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class BooksController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['add'],
                'rules' => [
                    [
                        'actions' => ['add'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Adding books action
     *
     * @return string
     */
    public function actionAdd(){
        $model = new BookForm();

        if(\Yii::$app->request->post($model->formName()) && $model->load(\Yii::$app->request->post())){
            if($model->validate()){
                if($model->save()){
                    \Yii::$app->session->addFlash('success', \Yii::t('messages', 'Book {title} successfully added!', ['title' => $model->title]));
                }else{
                    \Yii::$app->session->addFlash('danger', \Yii::t('messages', 'Oops! Some wrong in our part'));
                }
            }else{
                $errors = null;

                foreach($model->getErrors() as $error){
                    $errors .= Html::tag('br').array_shift($error);
                }

                \Yii::$app->session->addFlash('danger', \Yii::t('messages', 'Form have errors: {fields}', ['fields' => $errors]));
            }
        }

        return $this->render('add', [
            'model' =>  $model,
            'tags' => BooksTags::find()->all(),
            'categories' => Categories::find()->all()
        ]);
    }

    /**
     * @param $id
     * @param null $slug
     * @return string
     *
     * @throws NotFoundHttpException
     */
    public function actionView($id, $slug = null){
        $book = Books::findOne(['id' => $id]);

        if(!$book){
            throw new NotFoundHttpException('Book not found!');
        }


        return $this->render('view', [
            'book'  =>  $book
        ]);
    }
}
