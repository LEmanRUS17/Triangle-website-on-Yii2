<?php

namespace app\modules\blog\controllers;

use yii\web\Controller;

/**
 * Default controller for the `blog` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionClassic()
    {
        //$data = Article::getAll(3);

        return $this->render('classic'/*, [
            'articles'   => $data['articles'],
            'pagination' => $data['pagination'],
        ]*/);
    }
}
