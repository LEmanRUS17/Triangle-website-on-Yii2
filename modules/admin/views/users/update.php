<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'TITLE_ADMIN'), 'url' => ['default/index']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ADMIN_USERS'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = Yii::t('app', 'TITLE_USER_UPDATE');
?>
<section id="user-profiles-update">
    <div class="container user-update">

        <h1 class="title"><?= Html::encode($this->title) ?>: <?= $model->username ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</section>
