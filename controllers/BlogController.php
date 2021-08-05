<?php

namespace app\controllers;

class BlogController extends AppController
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('blog_default');
    }
}