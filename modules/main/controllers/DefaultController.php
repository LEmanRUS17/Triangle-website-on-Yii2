<?php

namespace app\modules\main\controllers;

use yii\web\Controller;

/**
 * Default controllers for the `main` module
 */
class DefaultController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
/*
    public function actionIndex()
    {
        return $this->render('index');
    }*/

//    public function actionsComingSoon()
//    {
//        return $this->render('coming-soon');
//    }

}
