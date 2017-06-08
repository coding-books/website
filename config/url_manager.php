<?php
$urlLangs = require(__DIR__ . '/url_lang.php');

return [
    'class' => 'codemix\localeurls\UrlManager',
    'languages' => $urlLangs,
    'enableDefaultLanguageUrlCode' => true,
    'enableLanguagePersistence' => false,
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        '<controller:(books)>/<action:(view)>/<id>-<slug>' => '<controller>/<action>',
        '<controller:(books)>/<action:(edit)>/<id>' => '<controller>/<action>',
        '<controller:(books)>/<action:(publish)>/<id>' => '<controller>/<action>',
        '<action:(search)>/<searchQuery>' => 'site/<action>',
    ],
];