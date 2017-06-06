<?php

namespace app\controllers;

use app\models\Books;
use app\models\BooksTags;
use app\models\forms\BookForm;
use Yii;
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
        $book = new Books();

        if(\Yii::$app->request->post($model->formName()) && $model->load(\Yii::$app->request->post())){
            if($model->validate()){
                $model->setBookModel($book);
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
            'tags' => BooksTags::find()->all()
        ]);
    }

    /**
     * Edit books action
     *
     * @return string
     */
    public function actionEdit(){
        $model = new BookForm();
        $model->isNew = false;
        $book = Books::findOne(Yii::$app->request->get('id'));

        $model->loadBook($book);
        $model->setBookModel($book);

        if(\Yii::$app->request->post($model->formName()) && $model->load(\Yii::$app->request->post())){
            if($model->validate()){
                if($model->save()){
                    \Yii::$app->session->addFlash('success', \Yii::t('messages', 'Book {title} successfully updated!', ['title' => $model->title]));
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
            'tags' => BooksTags::find()->all()
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

    public function actionPublish () {

        if (Yii::$app->request->isGet) {
            $id = intval(Yii::$app->request->get('id'));

            if (!empty($id)) {
                $book = Books::findOne($id);

                if (!empty($book)) {
                    $book->publish();
                    if ($book->save()) {
                        Yii::$app->session->addFlash('success', \Yii::t('messages', 'Book {title} successfully published!', ['title' => $book->title]));
                    } else {
                        Yii::$app->session->addFlash('danger', \Yii::t('messages', 'Something went wrong!', ['title' => $book->title]));
                    }
                }

                return $this->redirect(Yii::$app->request->referrer);
            }
        }

        return $this->render('publish', [
            'books'  =>  Books::getInactive()
        ]);
    }
}
