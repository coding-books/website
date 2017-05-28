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
    ],
];