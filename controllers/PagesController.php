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
}