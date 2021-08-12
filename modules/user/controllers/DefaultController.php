<?php

namespace app\modules\user\controllers;

use app\modules\user\models\EmailConfirm;
use app\modules\user\models\LoginForm;
use app\modules\user\models\PasswordResetRequestForm;
use app\modules\user\models\ResetPasswordForm;
use app\modules\user\models\SignUpForm;
use yii\base\InvalidArgumentException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use Yii;

class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signUp'],
                'rules' => [
                    [
                        'actions' => ['signUp'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->redirect(['profile/index'], 301);
    }

    public function actionLogin() // Вход в акаунт
    {
        $this->view->title = Yii::t('app', 'TITLE_LOGIN');
        if (!Yii::$app->user->isGuest) { // Если выполнен вход
            return $this->goHome(); // Вернуть на главную
        }

        $model = new LoginForm(); // Обект модели LoginForm
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', compact('model'));
        }
    }

    public function actionLogout() // Выход из акаунта
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignUp() // Регестрация
    {
        $this->view->title = Yii::t('app', 'TITLE_SIGN_UP');

        $model = new SignUpForm(); // Обект модели SignUpForm
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signUp()) {
                Yii::$app->getSession()->setFlash('success', 'Подтвердите ваш электронный адрес.');
                return $this->goHome();
            }
        }

        return $this->render('signUp', compact('model'));
    }

    public function actionEmailConfirm($token) // Подтверждение электронной почты
    {
        try {
            $model = new EmailConfirm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->confirmEmail()) {
            Yii::$app->getSession()->setFlash('success', 'Спасибо! Ваш Email успешно подтверждён.');
        } else {
            Yii::$app->getSession()->setFlash('error', 'Ошибка подтверждения Email.');
        }

        return $this->goHome();
    }

    public function actionPasswordResetRequest() // Запрос на сброс пароля
    {
        $this->view->title = Yii::t('app', 'TITLE_PASSWORD_RESET_REQUEST');

        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Спасибо! На ваш Email было отправлено письмо со ссылкой на восстановление пароля.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Извините. У нас возникли проблемы с отправкой.');
            }
        }

        return $this->render('requestPasswordResetToken', compact('model'));
    }

    public function actionPasswordReset($token) // Сброс пароля
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'Спасибо! Пароль успешно изменён.');

            return $this->goHome();
        }

        return $this->render('resetPassword', compact('model'));
    }
}
