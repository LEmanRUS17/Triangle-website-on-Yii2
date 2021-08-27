<?php

namespace app\modules\admin;

use yii\base\Application;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        //$this->registerDependencies($app);
        $this->registerTranslations($app);
    }

    public function registerTranslations(Application $app)
    {
        $app->i18n->translations['modules/admin/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'basePath' => '@app/modules/admin/messages',
            'fileMap' => [
                'modules/admin/module' => 'module.php',
            ],
        ];
    }

   /* private function registerDependencies(Application $app)
    {
        $container = \Yii::$container;

        $container->set(PasswordResetRequestForm::class, [], [
            $app->params['user.passwordResetTokenExpire'],
        ]);

        $container->set(SignupForm::class, [], [
            $app->params['user.defaultRole'],
        ]);

        $container->set(PasswordResetForm::class, function ($container, $args) use ($app) {
            return new PasswordResetForm($args[0], $app->params['user.passwordResetTokenExpire']);
        });

        $container->set(UserQuery::class, function ($container, $args) use ($app) {
            return new UserQuery($args[0], $app->params['user.emailConfirmTokenExpire']);
        });
    }*/
}
