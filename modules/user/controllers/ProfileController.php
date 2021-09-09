<?php

namespace app\modules\user\controllers;

use app\modules\user\forms\ProfileUpdateForm;
use app\modules\user\forms\PasswordChangeForm;
use app\modules\user\models\User;
use app\modules\user\Module;
use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;

class ProfileController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex() // Страница просмотра профиля
    {
        $this->view->title = Module::t('module', 'TITLE_PROFILE'); // Заголовок страницы

        $model = $this->findModel(); // Получить модель пользователя

        return $this->render('index', compact('model')); // Перейти на страницу "Профиль пользователя"
    }

    public function actionUpdate() // Страница редактирования профиля
    {
        $this->view->title = Module::t('module', 'TITLE_PROFILE_UP'); // Заголовок страницы

        $user  = $this->findModel();           // Получить модель пользователя
        $model = new ProfileUpdateForm($user); // Получить модель редактирования пользователя

        if ($model->load(Yii::$app->request->post()) && $model->update()) { // Если: данные получены методом пост && данные профиля обновлены
            return $this->redirect(['index']); // Перейти на страницу "Профиль пользователя"
        } else {
            return $this->render('up_date', compact('model')); // Перейти на страницу "Редактирование пользователя"
        }
    }

    public function actionPasswordChange() // Страница смены пароля
    {
        $this->view->title = Module::t('module', 'TITLE_PASSWORD_CHANGE'); // Заголовок страницы

        $user = $this->findModel();             // Получить модель пользователя
        $model = new PasswordChangeForm($user); // Получить модель смены пароля пользователя

        if ($model->load(Yii::$app->request->post()) && $model->changePassword()) { // Если: данные получены методом пост && изменен пароль
            return $this->redirect(['index']); // Перейти на страницу "Профиль пользователя"
        } else {
            return $this->render('passwordChange', compact('model')); // Перейти на страницу "Редактирование пароля"
        }
    }

    /**
     * @return User загруженная модель
     */
    private function findModel() // Связь с моделью User
    {
        return User::findOne(Yii::$app->user->identity->getId());
    }
}