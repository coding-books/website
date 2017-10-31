<?php

/* @var $this yii\web\View */
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;

/* @var $books array */
/* @var $book \app\models\Books */
/* @var $booksPhotos \app\models\BooksPhotos */
/* @var $booksDataProvider ActiveDataProvider */
/* @var $popularBooksDataProvider ActiveDataProvider */

$this->title = Yii::t('seo','{appName} - Coding books | Programming Library', ['appName' => \Yii::$app->name]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => Yii::t('seo', 'CoBooks is an online library consisting of books about programming, management of IT projects and other areas related to IT. Site for free online reading and downloading books in different formats.')
]);
?>
<div class="row clearfix text-center">
    <h2 class="title-one">
        <?= Yii::t('seo', 'Free IT e-library') ?>
    </h2>
    <div id="books-categories" class="portfolio-filter">
        <ul class="nav nav-pills text-center">
            <li class="active">
                <a data-toggle="pill"  href="#popular-books">
                    <?= Yii::t('books', 'Popular Books') ?>
                </a>
            </li>
            <li>
                <a data-toggle="pill"  href="#last-books">
                    <?= Yii::t('categories', 'Novelties') ?>
                </a>
            </li>
        </ul>
    </div>
    <div class="tab-content">
        <div id="popular-books" class="tab-pane fade in active">
            <div class="books-box">
                <?= ListView::widget([
                    'dataProvider' => $popularBooksDataProvider,
                    'summary' => false,
                    'layout' => '{items}',
                    'itemView' => '/parts/book',
                ]); ?>

                <a class="btn btn-default" href="<?= \yii\helpers\Url::to(['/book/popular']) ?>">
                    <?= Yii::t('app', 'View all') ?>
                </a>
            </div>
        </div>
        <div id="last-books" class="tab-pane fade">
            <div class="books-box">
                <?= ListView::widget([
                    'dataProvider' => $booksDataProvider,
                    'summary' => false,
                    'layout' => '{items}',
                    'itemView' => '/parts/book',
                ]); ?>

                <a class="btn btn-default" href="<?= \yii\helpers\Url::to(['/book/last']) ?>">
                    <?= Yii::t('app', 'View all') ?>
                </a>
            </div>
        </div>
    </div>
</div>

