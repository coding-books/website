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
    <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-101523366-1', 'auto');
          ga('send', 'pageview');
    </script>
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
                <a class="navbar-brand" href="<?= Url::to(['/']) ?>" >
                    <span><?= Yii::$app->name  ?></span>
                </a>
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
                                    'url' => ['/book/publish'],
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
                        $menuItems = ['label' => Yii::t('menu', 'Login'), 'url' => ['/user/login'], 'linkOptions' => ['rel' => 'nofollow']];
                    }

                    echo Nav::widget([
                        'options' => ['class' => 'nav navbar-nav navbar-right'],
                        'items' => [
                            ['label' => Yii::t('buttons', 'Add book'), 'url' => ['/book/add'], 'linkOptions' => ['rel' => 'nofollow']],
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
    <?php if (Yii::$app->controller->id == 'site' && (Yii::$app->controller->action->id == 'index' || Yii::$app->controller->action->id == 'search')) {?>
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
        'title' => Yii::t('notify', 'Note'),
        'showSeparator' => true,
        'body' => Yii::$app->session->getFlash('success')
    ]) ?>
<?php }else if(\Yii::$app->session->getFlash('danger')){ ?>
    <?= Growl::widget([
        'type' => Growl::TYPE_DANGER,
        'title' => Yii::t('notify', 'Warning'),
        'icon' => 'glyphicon glyphicon-exclamation-sign',
        'body' => \Yii::$app->session->getFlash('danger'),
        'showSeparator' => true
    ]) ?>
<?php } ?>

<footer id="footer">
    <div class="container">
        <div class="text-center">
            <div class="social-icons">
                <a target="_blank" rel="nofollow" href="https://www.facebook.com/cobooks.elibrary"><i class="fa fa-facebook"></i></a>
                <a target="_blank" rel="nofollow" href="https://twitter.com/CoBookselibrary"><i class="fa fa-twitter"></i></a>
                <a target="_blank" rel="nofollow" href="https://plus.google.com/u/4/116106420087536230816"><i class="fa fa-google-plus"></i></a>
                <a target="_blank" rel="nofollow" href="https://www.linkedin.com/in/co-books-07a445146"><i class="fa fa-linkedin"></i></a>
                <a target="_blank" rel="nofollow" href="https://vk.com/cobooks_lib"><i class="fa fa-vk"></i></a>
            </div>
            <p>CoBooks © 2017</p>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
