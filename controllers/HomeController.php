<?php

namespace app\controllers;

use Yii;

class HomeController extends AppController
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
//        Yii::$app->mailer->compose()
//            ->setFrom('lemanrus17@gmail.com')
//            ->setTo('lemanrus17@gmail.com')
//            ->setSubject('Тема сообщения')
//            ->setTextBody('Текст сообщения')
//            ->setHtmlBody('<b>текст сообщения в формате HTML</b>')
//            ->send();
        return $this->render('index');
    }
}