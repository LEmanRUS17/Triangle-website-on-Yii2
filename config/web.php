<?php

use yii\helpers\ArrayHelper;

$params = ArrayHelper::merge(
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

$config = [
    'id' => 'app',
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            //'layout' => '@app/views/layouts/admin',
            'modules' => [
                'user' => [
                    'class' => 'app\modules\user\Module',
                    'controllerNamespace' => [
                        'app\modules\user\controllers\backend',
                        ],
                    'viewPath' => '@app/modules/user/views/backend',
                ],
                'blog' => [
                    'class' => 'app\modules\blog\Module',
                    'controllerNamespace' => [
                        'app\modules\bloc\controllers\backend',
                    ],
                    'viewPath' => '@app/modules/blog/views/backend',
                ],
            ]
        ],
        'main' => [
            'class' => 'app\modules\main\Module',
        ],
        'page' => [
            'class' => 'app\modules\page\Module',
            ],
        'user' => [
            'class' => 'app\modules\user\Module',
            'controllerNamespace' => 'app\modules\user\controllers\frontend',
            'viewPath' => '@app/modules/user/views/frontend',
        ],
        'blog' => [
            'class' => 'app\modules\blog\Module',
            'controllerNamespace' => 'app\modules\blog\controllers\frontend',
            'viewPath' => '@app/modules/blog/views/frontend',
        ],
    ],
    'components' => [
        'user' => [
            'identityClass'   => 'app\modules\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl'        => ['user/default/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'main/default/error',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
