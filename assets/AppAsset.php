<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/main.css?42',
        'css/prettyPhoto.css',
        'css/responsive.css?1',
    ];
    public $js = [
        'js/jquery.isotope.min.js',
        'js/jquery.parallax.js',
        'js/jquery.prettyPhoto.js',
        'js/jquery-migrate.min.js',
        'js/main.js',
        'js/smoothscroll.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'rmrevin\yii\fontawesome\AssetBundle'
    ];
}
