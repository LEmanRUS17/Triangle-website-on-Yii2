<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\modules\user\models\User */

//$this->title = Yii::t('app', 'ADMIN');
//$this->params['breadcrumbs'][] = $this->title;

?>
<section id="admin-index">
    <div class="container admin-default-index">
        <h1 class="title"><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a(Yii::t('app', 'ADMIN_USERS'), ['users/index'], ['class' => 'btn btn-primary']) ?>
        </p>
    </div>
</section>