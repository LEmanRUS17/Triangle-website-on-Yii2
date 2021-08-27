<?php

namespace app\modules\admin\controllers;

use app\modules\admin\Module;
use Yii;
use app\modules\admin\models\User;
use app\modules\admin\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController реализует действия CRUD для модели User.
 */
class UsersController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Перечисляет все модели пользователей.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->view->title = Module::t('module', 'TITLE_USER_PROFILES');

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Отображает одну модель пользователя.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException если модель не может быть найдена
     */
    public function actionView($id)
    {
        $this->view->title = Module::t('module', 'TITLE_USER_PROFILE');
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Создает новую модель пользователя.
     * Если создание прошло успешно, браузер будет перенаправлен на страницу просмотра.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->view->title = Module::t('module', 'TITLE_USER_CREATE');

        $model = new User();
        $model->scenario = User::SCENARIO_ADMIN_CREATE;
        $model->status   = User::STATUS_ACTIVE;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Обновляет существующую модель пользователя.
     * Если обновление прошло успешно, браузер будет перенаправлен на страницу просмотра.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException если модель не может быть найдена
     */
    public function actionUpdate($id)
    {
        $this->view->title = Module::t('module', 'TITLE_USER_UPDATE');

        $model = $this->findModel($id);                 // Получить пользователя по $id
        $model->scenario = User::SCENARIO_ADMIN_UPDATE; // Запуск сценария

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Удаляет существующую модель пользователя.
     * Если удаление прошло успешно, браузер будет перенаправлен на страницу индекса.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException если модель не может быть найдена
     */
    public function actionDelete($id) // Удаление пользователя, по его id
    {
        $this->findModel($id)->delete(); // Удалить пользователя

        return $this->redirect(['index']);
    }

    /**
     * Находит модель пользователя на основе значения ее первичного ключа.
     * Если модель не найдена, будет выдано исключение 404 HTTP.
     * @param integer $id
     * @return User загруженная модель
     * @throws NotFoundHttpException если модель не может быть найдена
     */
    protected function findModel($id) // Получить модель пользователя по id
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Module::t('module', 'MESSAGE_PAGE_DOES_NOT_EXIT')); // Сообщение об ошибке
    }
}
