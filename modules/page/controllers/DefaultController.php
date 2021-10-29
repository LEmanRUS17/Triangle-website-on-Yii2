<?php

namespace app\modules\page\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('about');
    }

    public function actionAbout2()
    {
        return $this->render('about2');
    }

    public function actionService()
    {
        return $this->render('service');
    }

    public function actionPricing()
    {
        return $this->render('pricing');
    }
}