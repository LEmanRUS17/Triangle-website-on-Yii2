<?php

namespace app\modules\blog\controllers\backend;

use app\modules\blog\models\backend\Article;
use app\modules\blog\Module;
use app\modules\blog\models\backend\ArticleSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class DefaultController extends \yii\web\Controller
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
     * Перечисляет все модели .
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch(); // Получить всех пользователей
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [ // Рендер вида
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id); // Получить модель пользователя по $id

        return $this->render('view', compact('model')); // Рендер вида
    }

    /**
       * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     * @return Article
     * @throws NotFoundHttpException
     */
    protected function findModel($id) // Получить модель пользователя по id
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Module::t('module', 'MESSAGE_PAGE_DOES_NOT_EXIT')); // Сообщение об ошибке
    }
}
