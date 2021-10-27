<?php

namespace app\controllers;

class PagesController extends AppController
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

//    public function actionContact()
//    {
//        return $this->render('contact');
//    }
//
//    public function actionContact2()
//    {
//        return $this->render('contact2');
//    }
}