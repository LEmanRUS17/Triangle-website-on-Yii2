<?php

use app\modules\admin\components\grid\LinkColumn;
use app\modules\admin\components\grid\SetColumn;
use app\modules\admin\components\UserStatusColumn;
use app\modules\admin\models\User;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\modules\admin\components\grid\ActionColumns;
use app\modules\admin\Module;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->params['breadcrumbs'][] = $this->title;
?>
<section id="user-profiles">
    <div class="container user-index">

        <h1 class="title"><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a(Module::t('module', 'USERS_PROFILE_CREATE_BUTTON'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'id',
                [
                    'filter' => DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'date_from',
                        'attribute2' => 'date_to',
                        'type' => DatePicker::TYPE_RANGE,
                        'separator' => '-',
                        'pluginOptions' => ['format' => 'yyyy-mm-dd']
                    ]),
                    'attribute' => 'created_at',
                    'format' => 'datetime',
                ],
                [
                    'class' => LinkColumn::class,
                    'attribute' => 'username',
                ],

                'email:email',
                //'created_at:datetime',
                //'updated_at:datetime',
                //'auth_key',
                //'email_confirm_token:email',
                //'password_hash',
                //'password_reset_token',
                [
                    'class' => SetColumn::class,
                    'filter' => User::getStatusesArray(),
                    'attribute' => 'status',
                    'name' => 'statusName',
                    'cssCLasses' => [
                        User::STATUS_ACTIVE  => 'success',
                        User::STATUS_WAIT    => 'warning',
                        User::STATUS_BLOCKED => 'default',
                    ],
                ],
                ['class' => ActionColumns::class], // Настройка столбца действий через отдельный класс
            ],
        ]); ?>

        <?php Pjax::end(); ?>

    </div>
</section>
