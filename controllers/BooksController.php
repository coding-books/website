<?php

namespace app\controllers;

use app\models\forms\BookForm;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

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
                    \Yii::trace('success');
                    \Yii::$app->session->addFlash('success', \Yii::t('messages', 'Book {title} successfully added!', ['title' => $model->title]));
                }else{
                    \Yii::trace('fail');
                    \Yii::$app->session->addFlash('danger', \Yii::t('messages', 'Oops! Some wrong in our part'));
                }
            }else{
                $errors = null;

                foreach($model->getErrors() as $error){
                    $errors .= Html::tag('br').array_shift($error);
                }

                \Yii::trace($errors);

                \Yii::$app->session->addFlash('danger', \Yii::t('messages', 'Form is not valid: {fields}', ['fields' => $errors]));
            }
        }

        return $this->render('add', [
            'model' =>  $model
        ]);
    }
}
