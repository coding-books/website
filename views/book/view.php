<?php
/**
 * Created by PhpStorm.
 * User: bobroid
 * Date: 5/30/17
 * Time: 9:41 AM
 *
 * @var \app\models\Books $book
 * @var string $pdfFile
 * @var $this \yii\web\View
 */
use yii\bootstrap\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;

\app\assets\JsSocialAsset::register($this);

$this->title = $book->title . ' - ';
$this->title .= Yii::t('seo', 'read online & free download book');

$seoShortDesc = StringHelper::truncateWords(
    yii\helpers\HtmlPurifier::process($book->description, [
        'HTML.Allowed' => ''
    ])
    ,
    15
);

$js = <<<JS
    $("#share-book").jsSocials({
        showLabel: false,
        shares: [
            'twitter', 'facebook', 'googleplus', 'linkedin', 'vkontakte', 'whatsapp', 'telegram', 'viber', 'pinterest', 'email', 'stumbleupon'
        ],
        url: document.location.href,
        text: '$seoShortDesc',
        shareIn: 'popup'
    });
JS;


$this->registerJs($js);

$this->registerMetaTag([
    'name' => 'description',
    'content' => StringHelper::truncateWords(
        yii\helpers\HtmlPurifier::process($book->description, [
            'HTML.Allowed' => ''
        ])
        ,
        20
    )
]);
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
            <h1 class="title">
                <?= Html::encode($book->title) ?>
            </h1>
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
                    <a href="#read" data-toggle="tab">
                        <i class="fa fa-book"></i>
                        <?= Yii::t('books', 'Read') ?>
                    </a>
                </li>
                <li class="">
                    <a href="<?= Url::to($book->getDownloadLink()) ?>" target="_blank">
                        <i class="fa fa-cloud-download"></i>
                        <?= Yii::t('books', 'Download') ?>
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
                <div class="tab-pane fade" id="read">
                    <div class="media">
                        <div class="media-body">
                            <div class="book-buttons">
                                <div class="btn-group" role="group">
                                    <a class="btn btn-primary" target="_blank" href="
                                        <?= Url::to([
                                                '/pdfjs',
                                            'file' => $book->getDownloadLink() . '#page=' . $book->getLastPage(),
                                            'zoom' => 'page-width'
                                        ]) ?>
                                    ">
                                        <?= Yii::t('book', 'Full-screen reading') ?>
                                    </a>
                                    <a class="btn btn-success" href="
                                        <?= Url::to([
                                                '/bookmark/save/',
                                            'id' => $book->id,
                                            'page' => 1
                                        ]) ?>
                                    ">
                                        <?= Yii::t('book', 'Save bookmark') ?>
                                    </a>
                                </div>
                            </div>
                            <?= \yii2assets\pdfjs\PdfJs::widget([
                                'url' => $pdfFile
                            ]); ?>
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
