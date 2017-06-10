<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\models\Books;
use kartik\growl\Growl;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use app\assets\AppAsset;
use yii\helpers\Url;


AppAsset::register($this);

$parallaxImg = Yii::getAlias('@web') . '/images/parallax.jpg';

$styles = <<<CSS
.parallax-section {
    background-image: url("$parallaxImg");
    height: 250px; 
}

#search-field {
    height: 50px;
    border-radius: 0;
}

.search-group .btn {
    font-weight: 400;
}
CSS;


$this->registerCss($styles);

$searchUrl = Url::to(['/search']);

$js = <<<JS
    function search () {
        location.href = '$searchUrl/' + $('#search-field').val();
    }
    
    $('#search-button, #search-button-mobile').on('click', function () {
        search();
    });
    
    $('#search-field').keyup(function(event){
        if(event.keyCode == 13){
            search();
        }
    });
JS;


$this->registerJs($js);

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
                    $menuItems = '';

                    if (!Yii::$app->user->isGuest) {
                        $menuItems = [
                            'label' => Yii::$app->user->identity->username,
                            'items' => [
                                [
                                    'label' => Yii::t('menu', 'Users'),
                                    'url' => ['/user/admin'],
                                    'visible' => Yii::$app->user->identity->isAdmin
                                ],
                                [
                                    'label' => Yii::t('menu','Translations'),
                                    'url' => ['/translations'],
                                    'visible' => Yii::$app->user->can('translateSite')
                                ],
                                [
                                    'label' => Yii::t('menu','Publish books ({count})', ['count' => Books::getInactiveCount()]),
                                    'url' => ['/books/publish'],
                                    'visible' => Yii::$app->user->can('publishBook')
                                ],
                                [
                                    'label' => Yii::t('menu','Logout'),
                                    'url' => ['/user/logout'],
                                    'linkOptions' => ['data-method' => 'post']
                                ]
                            ],
                        ];
                    }

                    if (Yii::$app->user->isGuest) {
                        $menuItems = ['label' => Yii::t('menu', 'Login'), 'url' => ['/user/login']];
                    }

                    echo Nav::widget([
                        'options' => ['class' => 'nav navbar-nav navbar-right'],
                        'items' => [
                            ['label' => Yii::t('buttons', 'Add book'), 'url' => ['/books/add']],
                            $menuItems,
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
    <?php if (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index' || Yii::$app->controller->action->id == 'search') {?>
        <div class="parallax-section">
            <div class="text-center clearfix">
                <div id="search-box" class="search-box col-md-6 col-md-offset-3 col-xs-10 col-xs-offset-1">
                    <div class="input-group search-group">
                        <input id="search-field" type="text" class="form-control" placeholder="<?= Yii::t('books', 'Search books') ?>" value="<?= Html::encode(strip_tags(trim(Yii::$app->request->get('searchQuery')))) ?>">
                        <div id="search-button" class="btn btn-default slider-btn animated bounceInUp input-group-addon">
                            <?= Yii::t('books', 'Search') ?>
                        </div>
                        <div id="search-button-mobile" class="btn btn-default slider-btn animated bounceInUp input-group-addon">
                            <i class="fa fa-search"></i>
                        </div>
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
