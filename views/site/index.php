<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $books array */
/* @var $book \app\models\Books */
/* @var $booksPhotos \app\models\BooksPhotos */

$this->title = Yii::t('seo','{appName} - Coding books | Programming Library', ['appName' => \Yii::$app->name]);
?>

<div class="row text-center clearfix">
   <h1></h1>
</div>
<div class="row">
    <?php foreach ($books as $book){ ?>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="single-blog row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <img src="<?= $book->getMainBookPhoto() ? $book->getMainBookPhoto()->src : \Yii::$app->params['no_image_src'] ?>" alt="<?= Html::encode(Yii::t('seo','{title} - Book cover', ['title' => $book->title])) ?>">
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <h4><?= Html::encode($book->title) ?></h4>
                    <ul class="post-meta">
                        <li><i class="fa fa-pencil-square-o"></i><strong> <?=\Yii::t('books', 'Author')?>:</strong> <?php //Html::encode($book->authors) ?></li>
                        <li><i class="fa fa-clock-o"></i><strong> <?=\Yii::t('books', 'Posted On')?>:</strong> <?=\Yii::$app->formatter->asDatetime($book->created)?></li>
                    </ul>
                    <a href="<?= Url::to(['books/view', 'slug' => $book->slug, 'id' => $book->id]) ?>" class="btn btn-xs btn-info" target="_blank">
                        <?= Yii::t('books','Read More') ?>
                    </a>
                    <a href="<?= Url::to($book->download_link) ?>" class="btn btn-xs btn-success" target="_blank">
                        <?= Yii::t('books','Download') ?>
                    </a>
                </div>
            </div>
        </div>
    <?php } ?>

</div>

