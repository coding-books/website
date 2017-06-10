<?php
/**
 * Created by PhpStorm.
 * User: bobroid
 * Date: 5/30/17
 * Time: 9:41 AM
 *
 * @var \app\models\Books $book
 */
use yii\bootstrap\Html;
use yii\helpers\Url;

$this->title = $book->title . ' - ';
$this->title .= Yii::t('seo', 'read online & free download programming books');
?>

<div class="text-center about-us">
    <div class="row">
        <div class="col-md-4">
            <img src="<?= $book->getMainBookPhoto() ? $book->getMainBookPhoto()->src : \Yii::$app->params['no_image_src'] ?>" alt="<?= Html::encode(Yii::t('seo','{title} - Book cover', ['title' => $book->title])) ?>">
        </div>
        <div class="col-md-8">
            <h3 class="title">
                <?= Html::encode($book->title) ?>
            </h3>
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#description" data-toggle="tab">
                        <i class="fa fa-info"></i>
                        <?= Yii::t('books', 'Description') ?>
                    </a>
                </li>
                <li class="">
                    <a href="#download" data-toggle="tab">
                        <i class="fa fa-book"></i>
                        <?= Yii::t('books', 'Read') ?>
                    </a>
                </li>
                <!--<li class="">
                    <a href="#comments" data-toggle="tab">
                        <i class="fa fa-comments-o"></i>
                        <?= Yii::t('books', 'Comments') ?>
                    </a>
                </li>-->
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="description">
                    <div class="media">
                        <div class="media-body">
                            <?= $book->description ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="download">
                    <div class="media">
                        <div class="media-body">
                            <a href="<?= Url::to($book->getDownloadLink()) ?>" class="btn btn btn-success" target="_blank">
                                <?= Yii::t('books','Download') ?>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="comments">
                    <div class="media">
                        <div class="media-body">
                            Comments...
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
