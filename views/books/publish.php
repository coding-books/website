<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $books array */
/* @var $book \app\models\Books */
/* @var $booksPhotos \app\models\BooksPhotos */


?>
<div class="row clearfix text-center">
    <h2 class="title-one">
        <?= Yii::t('books', 'Publish Books') ?>
    </h2>
    <div class="books-box">
        <?php foreach ($books as $book){ ?>
            <?= $this->render('/parts/book.php', [
                'book' => $book
            ]); ?>
        <?php } ?>
    </div>
</div>

