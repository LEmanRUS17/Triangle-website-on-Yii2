<?php

namespace app\controllers;

class PortfolioController extends AppController
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('portfolio_default');
    }
}