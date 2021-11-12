<?php

namespace app\modules\user\controllers\backend;

use app\modules\user\forms\LoginForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;


class UserController extends Controller
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
                'only' => ['logout'],
                'rules' => [
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
                    'logout' => ['post'],
                ],
            ],
        ];
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
}