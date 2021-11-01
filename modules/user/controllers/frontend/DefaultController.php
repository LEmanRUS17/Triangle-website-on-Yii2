<?php

namespace app\modules\user\controllers\frontend;

use app\modules\user\forms\frontend\EmailConfirm;
use app\modules\user\forms\LoginForm;
use app\modules\user\forms\frontend\PasswordResetRequestForm;
use app\modules\user\forms\frontend\PasswordResetForm;
use app\modules\user\forms\frontend\SignUpForm;
use app\modules\user\Module;
use Yii;
use yii\base\InvalidArgumentException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;


class DefaultController extends Controller
{
    /**
     * @var \app\modules\user\Module
     */
    public $module;

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

    public function actionIndex() // Главная
    {
        return $this->redirect(['profile/index'], 301); // Перемещение с кодом 301
    }

    public function actionLogin() // Вход в акаунт
    {
        if (!Yii::$app->user->isGuest) { // Если выполнен вход
            return $this->goHome(); // Вернуть на главную
        }

        $model = new LoginForm(); // Обект модели LoginForm
        if ($model->load(Yii::$app->request->post()) && $model->login()) { // Если: данные были загружены методом post && ыполнен вход
            return $this->goBack(); // Вернутся на предыдущию страницу
        } else {
            return $this->render('login', compact('model')); // Перейти на страницу входа в акаунт
        }
    }

    public function actionLogout() // Выход из акаунта
    {
        Yii::$app->user->logout(); // Выйти из акаунта
        return $this->goHome();    // Вернутся на главную
    }

    public function actionSignUp() // Регестрация
    {
        /** @var SignUpForm $model */
        $model = Yii::createObject(SignupForm::class); // Создание модели
        if ($model->load(Yii::$app->request->post())) { // Если модель загружена
            if ($user = $model->signUp()) {  // Если регестрация прошла успештно
                Yii::$app->getSession()->setFlash('success', Module::t('module', 'SUCCESS_EMAIL_ADDRESS_CONFIRM')); // Вывести сообщение
                return $this->goHome(); // Вернутся на главную
            }
        }

        return $this->render('signUp', compact('model')); // Направить на страницу регестрации
    }

    public function actionEmailConfirm($token) // Подтверждение электронной почты
    {
        // Если модель не саздана будет выполнено действие при ошибке:
        try {
            $model = new EmailConfirm($token); // Создать модель формы по токену
        } catch (InvalidArgumentException  $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->confirmEmail()) { // Если email был подтвержден
            Yii::$app->getSession()->setFlash('success', Module::t('module', 'SUCCESS_EMAIL_SUCCESSFULLY_VERIFIED')); // Вывод сообщения
        } else {
            Yii::$app->getSession()->setFlash('error', Module::t('module', 'ERROR_EMAIL_CONFIRMATION')); // Вывод сообщения
        }

        return $this->goHome(); // Вернутся на главную
    }

    public function actionPasswordResetRequest() // Запрос на сброс пароля
    {
        /** @var PasswordResetRequestForm $model */
        $model = Yii::createObject(PasswordResetRequestForm::class); // Создание модели
        if ($model->load(Yii::$app->request->post()) && $model->validate($model->email)) { // Если: данные загружены методом post && email прошол валидацию
            if ($model->sendEmail()) { // Если писмь для сброса пароля было отправлено
                Yii::$app->getSession()->setFlash('success', Module::t('module', 'SUCCESS_EMAIL_RESET_PASSWORD')); // Вывод сообщения
                return $this->goHome(); // Вернутся на главную
            } else {
                Yii::$app->getSession()->setFlash('error', Module::t('module', 'ERROR_PROBLEM_SHIPPING')); // Вывод сообщения
            }
        }

        return $this->render('requestPasswordResetToken', compact('model')); // Направление на страницу востановления пароля
    }

    public function actionPasswordReset($token) // Сброс пароля
    {
        // Если модель не саздана будет выполнено действие при ошибке:
        try {
            /** @var PasswordResetForm $model */
            $model = Yii::createObject(PasswordResetForm::class, [$token]);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());

        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) { // Если: данные загружены методом post && модель прошла валидацию && сброс пароля
            Yii::$app->getSession()->setFlash('success', Module::t('module', 'SUCCESS_PASSWORD_SUCCESSFULLY')); // Вывод сообщения
            return $this->goHome(); // Вернутся на главную
        }

        return $this->render('resetPassword', compact('model')); // Направление на страницу сброса пароля
    }
}