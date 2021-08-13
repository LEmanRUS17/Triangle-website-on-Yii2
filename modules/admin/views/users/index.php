<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->params['breadcrumbs'][] = $this->title;
?>
<section id="user-profiles">
    <div class="container user-index">

        <h1 class="title"><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a(Yii::t('app', 'USERS_PROFILE_CREATE_BUTTON'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'created_at',
                'updated_at',
                'username',
                'auth_key',
                //'email_confirm_token:email',
                //'password_hash',
                //'password_reset_token',
                //'email:email',
                //'status',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>

        <?php Pjax::end(); ?>

    </div>
</section>
