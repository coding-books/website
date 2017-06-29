<?php
$urlLangs = require(__DIR__ . '/url_lang.php');

return [
    'class' => 'codemix\localeurls\UrlManager',
    'languages' => $urlLangs,
    'enableLanguagePersistence' => false,
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'ignoreLanguageUrlPatterns' => [
        '#^user/auth#' => '#^user/security/auth#',
    ],
    'rules' => [
        '<module:(pdfjs)>' => '<module>/default/index',
        '' => 'site/index',
        '<action>' => 'site/<action>',
        '<controller:(book)>/<id>-<slug>' => '<controller>/view',
        '<controller:(book)>/<action:(edit)>/<id>' => '<controller>/<action>',
        '<controller:(book)>/<action:(publish)>/<id>' => '<controller>/<action>',
        '<controller:(bookmark)>/<action:(save)>/<id>/<page>' => '<controller>/<action>',
        '<action:(search)>/<searchQuery>' => 'site/<action>',
    ],
];