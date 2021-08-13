<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<section id="user-profiles-view">
    <div class="container user-view">

        <h1 class="title"><?= Html::encode($this->title) ?>: <?= $model->username ?></h1>

        <p>
            <?= Html::a(Yii::t('app', 'USERS_PROFILE_UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'USERS_PROFILE_DELETE'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'created_at',
                'updated_at',
                'username',
                'auth_key',
                'email_confirm_token:email',
                'password_hash',
                'password_reset_token',
                'email:email',
                'status',
            ],
        ]) ?>

    </div>
</section>
