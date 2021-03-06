<?php

namespace app\controllers;

use app\models\book\BookSearch;
use app\models\Books;
use app\models\BooksViews;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\ContactForm;

/**
 * Class SiteController
 * @package app\controllers
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
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
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Books::find()->where(['published' => 1])->orderBy(['created' => SORT_DESC])->limit(6),
            'pagination' => [
                'pageSize' => 6,
            ],
        ]);

        $popularBooksDataProvider = new ActiveDataProvider([
            'query' => Books::getMostPopularQuery(),
            'pagination' => [
                'pageSize' => 6,
            ],
        ]);

        return $this->render('index', [
            'booksDataProvider' => $dataProvider,
            'popularBooksDataProvider' => $popularBooksDataProvider,
        ]);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionSearch($searchQuery)
    {
        $searchString = strip_tags(trim($searchQuery));

        $searchModel = new BookSearch();
        $books = $searchModel->search($searchString);

        return $this->render('search', [
            'books' => $books,
            'searchString' => $searchString
        ]);
    }
}
