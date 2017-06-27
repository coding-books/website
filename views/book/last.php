<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/* @var $booksDataProvider \yii\data\ActiveDataProvider */

$this->title = Yii::t('seo','Last Books | {appName}', ['appName' => \Yii::$app->name]);
?>
<div class="row clearfix text-center">
    <h4 class="title-one">
        <?= Yii::t('books', 'Last books') ?>
    </h4>
    <div class="books-box">
        <?= ListView::widget([
            'dataProvider' => $booksDataProvider,
            'summary' => false,
            'layout' => "{items}\n<div class='col-md-12'>{pager}</div>",
            'itemView' => '/parts/book',
        ]); ?>
    </div>
</div>

