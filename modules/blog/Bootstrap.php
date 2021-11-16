<?php

namespace app\modules\blog;

use yii\base\Application;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        //$this->registerDependencies($app);
        $this->registerTranslations($app);
    }

    public function registerTranslations(Application $app) // Настройки переводчика i18n
    {
        $app->i18n->translations['modules/blog/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'basePath' => '@app/modules/blog/messages',
            'fileMap' => [
                'modules/blog/module' => 'module.php',
            ],
        ];
    }

}
