<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $books array */
/* @var $book \app\models\Books */
/* @var $booksPhotos \app\models\BooksPhotos */

$this->title = Yii::t('seo','Find Your Favourite Book | {appName}', ['appName' => \Yii::$app->name]);
?>
<div class="row clearfix text-center">
    <?php if (empty($books)) { ?>
        <div class="row text-center clearfix">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="contact-address">
                    <p>
                        <span>
                            <?= Yii::t('app', 'Nothing not found') ?>
                        </span>
                    </p>
                    <br>
                    <br>
                    <span>
                        <?= Yii::t('app', 'Try to change the search conditions') ?>
                    </span>
                    <br>
                    <br>
                    <strong>
                        <?= Yii::t('app', 'or') ?>
                    </strong>
                    <br>
                    <br>
                    <a class="btn btn-default slider-btn" href="<?= Url::to(['/books/add']) ?>">
                        <?= Yii::t('books', 'Add book') ?>
                    </a>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <h4 class="title-one">
            <?= Yii::t('books', 'Found books') ?>
        </h4>
        <div class="books-box">
            <?php foreach ($books as $model){ ?>
                <?= $this->render('/parts/book.php', [
                    'model' => $model
                ]); ?>
            <?php } ?>
        </div>
    <?php } ?>
</div>

