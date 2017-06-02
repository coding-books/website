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

$parallaxImg = Yii::getAlias('@web') . '/images/parallax.jpg';

$styles = <<<CSS
.parallax-section {
    background-image: url("$parallaxImg");
    height: 250px; 
}
CSS;


$this->registerCss($styles);
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
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span> 
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span> 
                </button>
                <a class="navbar-brand" href="<?= Yii::$app->homeUrl ?>" ><h1><?= Yii::$app->name  ?></h1></a>
            </div>
            <div class="collapse navbar-collapse">
                    <?php
                    echo Nav::widget([
                        'options' => ['class' => 'nav navbar-nav navbar-right'],
                        'items' => [
                            ['label' => Yii::t('buttons', 'Add book'), 'url' => ['/books/add']],
                            Yii::$app->user->isGuest ? (
                            ['label' => Yii::t('menu', 'Login'), 'url' => ['/user/login']]
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
    <div class="clearfix"></div>
</header>


<section>
    <?php if (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index') {?>
        <div class="parallax-section">
            <div class="text-center clearfix">
                <div id="search-box" class="search-box col-md-6 col-md-offset-3 col-xs-10 col-xs-offset-1">
                    <div class="input-group search-group">
                        <input type="text" class="form-control name-field" placeholder="<?= Yii::t('books', 'Search books') ?>">
                        <a class="btn btn-default slider-btn animated bounceInUp input-group-addon" href="#">
                            <?= Yii::t('books', 'Search') ?>
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    <?php } ?>
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
