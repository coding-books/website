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
        'css/font-awesome.min.css',
        'css/main.css',
        'css/prettyPhoto.css',
        'css/preview.css',
        'css/responsive.css',
    ];
    public $js = [
        'js/core.js',
        'js/jquery.isotope.min.js',
        'js/jquery.parallax.js',
        'js/jquery.prettyPhoto.js',
        'js/jquery-migrate.min.js',
        'js/jquery-noconflict.js',
        'js/main.js',
        'js/preview.js',
        'js/smoothscroll.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];
}
