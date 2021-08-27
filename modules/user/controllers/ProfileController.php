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
        $this->view->title = Module::t('module', 'TITLE_PROFILE');

        $model = $this->findModel();

        return $this->render('index', compact('model')); // Перейти на страницу "Профиль пользователя"
    }

    public function actionUpdate() // Страница редактирования профиля
    {
        $this->view->title = Module::t('module', 'TITLE_PROFILE_UP');

        $user  = $this->findModel();
        $model = new ProfileUpdateForm($user);

        if ($model->load(Yii::$app->request->post()) && $model->update()) { // Если модель была получена методом пост и сохранена
            return $this->redirect(['index']); // Перейти на страницу "Профиль пользователя"
        } else {
            return $this->render('up_date', compact('model')); // Перейти на страницу "Редактирование пользователя"
        }
    }

    public function actionPasswordChange() // Страница смены пароля
    {
        $this->view->title = Module::t('module', 'TITLE_PASSWORD_CHANGE');

        $user = $this->findModel();
        $model = new PasswordChangeForm($user);

        if ($model->load(Yii::$app->request->post()) && $model->changePassword()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('passwordChange', [
                'model' => $model,
            ]);
        }
    }

    /**
     * @return User the loaded model
     */
    private function findModel() // Связь с моделью User
    {
        return User::findOne(Yii::$app->user->identity->getId());
    }
}