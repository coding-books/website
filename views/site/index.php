<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $books array */
/* @var $book \app\models\Books */
/* @var $booksPhotos \app\models\BooksPhotos */

$this->title = Yii::$app->name . ' - ' . Yii::t('seo','Coding books | Programming Library');
?>

<div class="row text-center clearfix">
   <h1></h1>
</div>
<div class="row">
    <?php foreach ($books as $book){
        $booksPhotos = $book->booksPhotos[0];
        ?>
    <div class="col-sm-4">
        <div class="single-blog">
            <img src="<?= $booksPhotos->src ?>" alt="<?= Html::encode($book->title . ' - ' . Yii::t('seo','Book cover')) ?>">
            <h2><?= Html::encode($book->title) ?></h2>
            <ul class="post-meta">
                <li><i class="fa fa-pencil-square-o"></i><strong> Posted By:</strong> John</li>
                <li><i class="fa fa-clock-o"></i><strong> Posted On:</strong> Apr 15 2014</li>
            </ul>
            <div class="blog-content">
                <p><?= Html::encode($book->description) ?></p>
            </div>
            <a href="<?= Url::to([$book->slug]) ?>" class="btn btn-primary">
                <?= Yii::t('books','Read More') ?>
            </a>
            <a href="<?= Url::to([$book->download_link]) ?>" class="btn btn-success">
                <?= Yii::t('books','Download') ?>
            </a>
        </div>
    </div>
    <?php } ?>

</div>

