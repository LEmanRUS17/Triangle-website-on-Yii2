<?php

use yii\helpers\ArrayHelper;

$params = ArrayHelper::merge(
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'app\modules\admin\Bootstrap',
        'app\modules\main\Bootstrap',
        'app\modules\user\Bootstrap',
    ],
    'defaultRoute' => 'home/index',     // Дефолтный маршрут при запуске сайта
    'language'     => 'ru-RU',          // Язык
    'name'         => 'Triangle',       // Название сайта
    'layout'       => 'main',           // Шаблон по умолчанию
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        //'@tests' => '@app/tests',
    ],
    'components' => [
        'i18n' => [ // Переводчик
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'forceTranslation' => true,
                ],
                'modules/user/*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'forceTranslation' => true,
                    'basePath' => '@app/modules/user/messages',
                    'fileMap' => [
                        'modules/user/module' => 'module.php',
                    ],
                ],
            ],
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'urlManager' => [
            'enablePrettyUrl'     => true,
            'showScriptName'      => false,
            'enableStrictParsing' => false, // Включить строгий разбор UPL. https://www.yiiframework.com/doc/api/2.0/yii-web-urlmanager#$enableStrictParsing-detail
            'rules' => [/*
                //'' => 'main/default/index',
                'contact' => 'main/contact/index',
                '<_a:error>' => 'main/default/<_a>',
                '<_a:(login|logout|signUp|confirm-email|request-password-reset|reset-password)>' => 'user/default/<_a>',

                '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>' => '<_m>/<_c>/view',
                '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_m>/<_c>/<_a>',
                '<_m:[\w\-]+>' => '<_m>/default/index',
                //'<_m:[\w\-]+>/<_c:[\w\-]+>' => '<_m>/<_c>/index',*/
            ],
        ],
    ],
    'params' => $params,
];