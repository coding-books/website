<?php
$urlLangs = require(__DIR__ . '/url_lang.php');

return [
    'class' => 'codemix\localeurls\UrlManager',
    'languages' => $urlLangs,
    'enableDefaultLanguageUrlCode' => true,
    'enableLanguagePersistence' => false,
    'enablePrettyUrl' => true,
    'enableStrictParsing' => true,
    'showScriptName' => false,
    'rules' => [
        '<module:(pdfjs)>' => '<module>/default/index',
        '<action:\w+>' => 'site/<action>',
        '<controller:(book)>/<id>-<slug>' => '<controller>/view',
        '<controller:(book)>/<action:(edit)>/<id>' => '<controller>/<action>',
        '<controller:(book)>/<action:(publish)>/<id>' => '<controller>/<action>',
        '<action:(search)>/<searchQuery>' => 'site/<action>',
    ],
];