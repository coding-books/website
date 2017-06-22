<?php

namespace app\assets;

/**
 * Class JsSocialAsset
 *
 * @package app\assets
 */
class JsSocialAsset extends AppAsset
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        '//cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css',
        '//cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-flat.css',
    ];
    public $js = [
        '//cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.min.js',
    ];
}
