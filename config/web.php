<?php

$params = require(__DIR__ . '/params.php');
$cookieValidationKey = require(__DIR__ . '/validation_key.php');
$urlManager = require(__DIR__ . '/url_manager.php');
$urlLangs = require(__DIR__ . '/url_lang.php');
$mailer = require(__DIR__ . '/mailer_transport.php');
$socialClients = require(__DIR__ . '/social_clients.php');

$db = require(__DIR__ . ( YII_DEBUG ? '/db.php' : '/db_prod.php'));

$config = [
    'id' => 'basic',
    'language' => 'en',
    'name' => 'CoBooks',
    'sourceLanguage' => 'en',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableGeneratingPassword' => true,
            'enableConfirmation' => false,
            'cost' => 12,
            'admins' => ['mihail', 'Kravalg', 'bobroid']
        ],
        'rbac' => 'dektrium\rbac\RbacWebModule',
        'i18n' => Zelenin\yii\modules\I18n\Module::className()
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => $cookieValidationKey,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => $mailer,
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'i18n' => [
            'class' => Zelenin\yii\modules\I18n\components\I18N::className(),
            'languages' => $urlLangs
        ],
        'authClientCollection' => [
            'class'   => \yii\authclient\Collection::className(),
            'clients' => $socialClients,
        ],
        'db' => $db,
        'urlManager' => $urlManager
    ],
    'params' => array_merge(
        $params,
        ['langs' => $urlLangs]
    ),
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];
}

return $config;
