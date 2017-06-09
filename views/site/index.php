<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $books array */
/* @var $book \app\models\Books */
/* @var $booksPhotos \app\models\BooksPhotos */

$this->title = Yii::t('seo','{appName} - Coding books | Programming Library', ['appName' => \Yii::$app->name]);
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
        <?php foreach ($books as $book){ ?>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="single-blog row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <a href="<?= Url::to(['books/view', 'slug' => $book->slug, 'id' => $book->id]) ?>">
                        <img src="<?= $book->getMainBookPhoto() ? $book->getMainBookPhoto()->src : \Yii::$app->params['no_image_src'] ?>" alt="<?= Html::encode(Yii::t('seo','{title} - Book cover', ['title' => $book->title])) ?>">
                    </a>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div>
                        <a href="<?= Url::to(['books/view', 'slug' => $book->slug, 'id' => $book->id]) ?>">
                            <h4>
                                <?= Html::encode($book->title) ?>
                                <span class="badge" title="<?= Yii::t('books','The language of the book') ?>">
                                    <?= Html::encode(strtoupper($book->language_code)) ?>
                                </span>
                            </h4>
                        </a>
                        <div class="button-actions">
                            <a href="<?= Url::to(['books/view', 'slug' => $book->slug, 'id' => $book->id]) ?>" class="btn btn-xs btn-info">
                                <?= Yii::t('books','Read More') ?>
                            </a>
                            <a href="<?= Url::to($book->getDownloadLink()) ?>" class="btn btn-xs btn-success" target="_blank">
                                <?= Yii::t('books','Download') ?>
                            </a>
                            <?php if (Yii::$app->user->can('editBook')) {?>
                                <a href="<?= Url::to(['books/edit', 'id' => $book->id])?>" class="btn btn-xs btn-primary" target="_blank">
                                    <?= Yii::t('books','Edit') ?>
                                </a>
                            <?php } ?>
                        </div>
                        <ul class="post-meta">
                            <li>
                                <i class="fa fa-clock-o"></i>
                                <strong>
                                    <?= \Yii::t('books', 'Posted On') ?>
                                </strong>
                                <br>
                                <?= \Yii::$app->formatter->asDate($book->created, 'medium') ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    </div>
</div>

