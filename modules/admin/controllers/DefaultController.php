<?php

namespace app\modules\admin\controllers;

use app\modules\admin\Module;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $this->view->title = Module::t('module', 'TITLE_ADMIN');

        return $this->render('index');
    }
}
