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
                    <a href="<?= Url::to(['books/view', 'slug' => $book->slug, 'id' => $book->id]) ?>">
                        <img src="<?= $book->getMainBookPhoto() ? $book->getMainBookPhoto()->src : \Yii::$app->params['no_image_src'] ?>" alt="<?= Html::encode(Yii::t('seo','{title} - Book cover', ['title' => $book->title])) ?>">
                    </a>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div>
                        <a href="<?= Url::to(['books/view', 'slug' => $book->slug, 'id' => $book->id]) ?>">
                            <h4>
                                <?= Html::encode($book->title) ?>
                            </h4>
                        </a>
                        <ul class="post-meta">
                            <!--<li>
                            <i class="fa fa-pencil-square-o"></i><strong>
                                <?= \Yii::t('books', 'Author') ?>:</strong>
                            <?php //Html::encode($book->authors) ?>
                        </li>-->
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
                    <div class="button-actions">
                        <a href="<?= Url::to(['books/view', 'slug' => $book->slug, 'id' => $book->id]) ?>" class="btn btn-xs btn-info">
                            <?= Yii::t('books','Read More') ?>
                        </a>
                        <a href="<?= Url::to($book->getDownloadLink()) ?>" class="btn btn-xs btn-success" target="_blank">
                            <?= Yii::t('books','Download') ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

</div>

