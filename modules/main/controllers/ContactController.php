<?php


namespace app\modules\main\controllers;

use app\modules\main\models\ContactForm;
use yii\web\Controller;
use Yii;

class ContactController extends Controller
{
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex() // Страница обратной связи с автозаполнением
    {
        $model = new ContactForm(); // Обект модели ContactForm
        if ($user = Yii::$app->user->identity) { // Если пользователь авторизован
            // Заполнение данных:
            $model->name = $user->username;
            $model->email = $user->email;
        }
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        } else {
            return $this->render('index', compact('model'));
        }
    }
}