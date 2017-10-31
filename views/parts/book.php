<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $model \app\models\Books */

$this->title = Yii::t('seo','{appName} - Coding books | Programming Library', ['appName' => \Yii::$app->name]);
?>
<div class="col-md-4 col-sm-6 col-xs-12">
    <?php if ($this->beginCache('BookView' . $model->id, ['duration' => 86400])) {  ?>
        <div class="single-blog row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <a href="<?= Url::to(['book/view', 'slug' => $model->slug, 'id' => $model->id]) ?>">
                <img src="<?= $model->getMainBookPhoto() ? $model->getMainBookPhoto()->src : \Yii::$app->params['no_image_src'] ?>" alt="<?= Html::encode(Yii::t('seo','{title} - Book cover', ['title' => $model->title])) ?>">
            </a>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div>
                <a href="<?= Url::to(['book/view', 'slug' => $model->slug, 'id' => $model->id]) ?>">
                    <h4>
                        <?= Html::encode($model->title) ?>
                        <span class="badge" title="<?= Yii::t('books','The language of the book') ?>">
                                    <?= Html::encode(strtoupper($model->language_code)) ?>
                                </span>
                    </h4>
                </a>
                <div class="button-actions">
                    <a href="<?= Url::to(['book/view', 'slug' => $model->slug, 'id' => $model->id]) ?>" class="btn btn-xs btn-info">
                        <?= $this->renderDynamic('return Yii::t("books","Read More");'); ?>
                    </a>
                    <a href="<?= Url::to($model->getDownloadLink()) ?>" class="btn btn-xs btn-success" target="_blank">
                        <?= $this->renderDynamic('return Yii::t("books", "Download");') ?>
                    </a>
                    <a href="<?= Url::to([
                        '/pdfjs',
                        'file' => $model->getDownloadLink() . '#page=' . $model->getLastPage(),
                        'zoom' => 'page-width'
                    ]) ?>" class="btn btn-xs btn-default">
                        <?= $this->renderDynamic('return Yii::t("books", "Read online");') ?>
                    </a>
                </div>
                <ul class="post-meta">
                    <li>
                        <i class="fa fa-clock-o"></i>
                        <strong>
                            <?= $this->renderDynamic('return Yii::t("books", "Posted On");') ?>
                        </strong>
                        <br>
                        <?= $this->renderDynamic('return \Yii::$app->formatter->asDate($model->created, "medium");') ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <?php
        $this->endCache();}
    ?>
</div>