<?php
/**
 * Created by PhpStorm.
 * User: bobroid
 * Date: 5/30/17
 * Time: 9:41 AM
 *
 * @var \app\models\Books $book
 * @var $this \yii\web\View
 */
use yii\bootstrap\Html;
use yii\helpers\Url;

\app\assets\JsSocialAsset::register($this);

$this->title = $book->title . ' - ';
$this->title .= Yii::t('seo', 'read online & free download book');

$js = <<<JS
    $("#share-book").jsSocials({
        showLabel: false,
        shares: [
            'twitter', 'facebook', 'googleplus', 'linkedin', 'vkontakte', 'whatsapp', 'telegram', 'viber', 'pinterest', 'email', 'stumbleupon'
        ],
        url: document.location.href,
        text: '$this->title',
        shareIn: 'popup'
    });
JS;


$this->registerJs($js);
?>

<div class="text-center about-us">
    <div class="row">
        <div class="col-md-4">
            <img src="<?= $book->getMainBookPhoto() ? $book->getMainBookPhoto()->src : \Yii::$app->params['no_image_src'] ?>" alt="<?= Html::encode(Yii::t('seo','{title} - Book cover', ['title' => $book->title])) ?>">
            <p class="share-book">
                <?= Yii::t('share', 'Share it with friends') ?>
            </p>
            <div id="share-book"></div>
        </div>
        <div class="col-md-8">
            <h3 class="title">
                <?= Html::encode($book->title) ?>
            </h3>
            <div class="tags">
                <?php if (!empty($book->booksTags) && is_array($book->booksTags)) { ?>
                    <?php foreach ($book->booksTags as $tagRef) { ?>
                        <?php if (!empty($tagRef->tag)) { ?>
                            <a class="label label-info" href="<?= Url::to(['site/search', 'searchQuery' => $tagRef->tag->tag]) ?>" target="_blank">
                                <?= Html::encode($tagRef->tag->tag) ?>
                            </a>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </div>
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
