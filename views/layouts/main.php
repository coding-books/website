<?php

/* @var $this \yii\web\View */
/* @var $content string */

use kartik\growl\Growl;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<header id="navigation">
    <div class="navbar navbar-inverse navbar-fixed-top" role="banner">
        <div class="container">
            <div class="navbar-header">
               <?php
//                   NavBar::begin([
//                       'brandLabel' =>  Yii::$app->name ,
//                       'brandUrl' => Yii::$app->homeUrl,
//                   ]);
               ?>
                <a class="navbar-brand" href="<?= Yii::$app->homeUrl ?>" ><h1><?= Yii::$app->name  ?></h1></a>

            </div>
            <div class="collapse navbar-collapse">
                    <?php
                    echo Nav::widget([
                        'options' => ['class' => 'nav navbar-nav navbar-right'],
                        'items' => [
                            ['label' => 'About', 'url' => ['/site/about']],
                            ['label' => Yii::t('buttons', 'Add book'), 'url' => ['/books/add']],
                            Yii::$app->user->isGuest ? (
                            ['label' => 'Login', 'url' => ['/user/login']]
                            ) : (
                                '<li>'
                                . Html::beginForm(['/user/logout'], 'post')
                                . Html::submitButton(
                                    'Logout (' . Yii::$app->user->identity->username . ')',
                                    ['class' => 'btn btn-link logout']
                                )
                                . Html::endForm()
                                . '</li>'
                            )
                            ,
                            '<li> ' . \app\components\widgets\language\LanguageWidget::widget(['cssClass' => 'language-widget']) . '</li>'
                        ]
                    ]);

                    ?>

            </div>
        </div>
    </div><!--/navbar-->
</header>


<section>
    <div class="container">
        <?= $content ?>
    </div>
</section>
<?php if (\Yii::$app->session->getFlash('success')) {?>
    <?= Growl::widget([
        'type' => Growl::TYPE_SUCCESS,
        'icon' => 'glyphicon glyphicon-ok-sign',
        'title' => 'Note',
        'showSeparator' => true,
        'body' => Yii::$app->session->getFlash('success')
    ]) ?>
<?php }else if(\Yii::$app->session->getFlash('danger')){ ?>
    <?= Growl::widget([
        'type' => Growl::TYPE_DANGER,
        'title' => 'Warning!',
        'icon' => 'glyphicon glyphicon-exclamation-sign',
        'body' => \Yii::$app->session->getFlash('danger'),
        'showSeparator' => true
    ]) ?>
<?php } ?>

<footer id="footer">
    <div class="container">
        <div class="text-center">
            <p>CoBooks © 2017</p>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
