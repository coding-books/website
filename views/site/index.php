<?php

/* @var $this yii\web\View */
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;

/* @var $books array */
/* @var $book \app\models\Books */
/* @var $booksPhotos \app\models\BooksPhotos */
/* @var $booksDataProvider ActiveDataProvider */

$this->title = Yii::t('seo','{appName} - Coding books | Programming Library', ['appName' => \Yii::$app->name]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => Yii::t('seo', 'CoBooks is an online library consisting of books about programming, management of IT projects and other areas related to IT. Site for free online reading and downloading books in different formats.')
]);
?>
<div class="row clearfix text-center">
    <h2 class="title-one">
        <?= Yii::t('books', 'Popular Books') ?>
    </h2>
    <div id="books-categories">
        <ul class="portfolio-filter">
            <li>
                <a class="btn btn-default active" href="#" data-filter="*">
                    <?= Yii::t('categories', 'Novelties') ?>
                </a>
            </li>
            <!--<li>
                <a class="btn btn-default" href="#" data-filter=".html">
                    <?= Yii::t('categories', 'Popular') ?>
                </a>
            </li>
            <li>
                <a class="btn btn-default" href="#" data-filter=".wordpress">
                    <?= Yii::t('categories', 'OOP') ?>
                </a>
            </li>
            <li>
                <a class="btn btn-default" href="#" data-filter=".joomla">
                    <?= Yii::t('categories', 'GoF') ?>
                </a>
            </li>
            <li>
                <a class="btn btn-default" href="#" data-filter=".megento">
                    <?= Yii::t('categories', 'Web') ?>
                </a>
            </li>-->
        </ul>
    </div>
    <div class="books-box">
        <?= ListView::widget([
            'dataProvider' => $booksDataProvider,
            'summary' => false,
            'layout' => '{items}',
            'itemView' => '/parts/book',
        ]); ?>

        <a class="btn btn-default" href="<?= \yii\helpers\Url::to(['/books/last']) ?>">
            <?= Yii::t('app', 'View all') ?>
        </a>
    </div>
</div>

