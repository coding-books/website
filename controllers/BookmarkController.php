<?php

namespace app\controllers;

use app\models\Books;
use app\models\BooksTags;
use app\models\forms\BookForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Class BookmarkController
 * @package app\controllers
 */
class BookmarkController extends Controller
{

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

    public function actionSave () {

        if (Yii::$app->request->isGet) {
            $id = intval(Yii::$app->request->get('id'));
            $page = intval(Yii::$app->request->get('page'));

            Yii::$app->session->addFlash('success', \Yii::t('messages', 'Bookmark successfully saved'));

            /*if (!empty($id)) {
                $book = Books::findOne($id);

                if (!empty($book)) {
                    if ($book->save()) {
                        Yii::$app->session->addFlash('success', \Yii::t('messages', 'Book {title} successfully published!', ['title' => $book->title]));
                    } else {
                        Yii::$app->session->addFlash('danger', \Yii::t('messages', 'Something went wrong!', ['title' => $book->title]));
                    }
                }
            }*/
        }

        return $this->redirect(Yii::$app->request->referrer);
    }
}
