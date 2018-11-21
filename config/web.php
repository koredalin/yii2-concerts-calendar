<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'aOOHT_fi04aaB-8DlFqXhxnV0JJ2tg7P',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        /*
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        /**/
        /* Errors logging stopped
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        /**/
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
//            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'controllerMap' => [
                'admin' => '\app\controllers\user\AdminController',
            ],
            'modelMap' => [
                'User' => 'app\models\User',
            ],
            'enableUnconfirmedLogin' => true,
            'confirmWithin' => 21600,
            'admins' => ['admin'],
            'enableConfirmation' => true,
            'mailer' => [
                'sender'                => ['info@example.com' => 'Sender name'],
                'welcomeSubject'        => 'Welcome to http://example.com',
                'confirmationSubject'   => 'http://example.com. Please, confirm your e-mail address',
                'reconfirmationSubject' => 'http://example.com. Please, reconfirm your e-mail address',
                'recoverySubject'       => 'http://example.com. Password recovery',
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
