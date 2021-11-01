<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\user\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

$this->title = Module::t('module', 'TITLE_USER_PROFILE');
//$this->params['breadcrumbs'][] = $this->title;
?>
<section id="profile">
    <div class="container user-profile">

        <h1 class="title"><?= Html::encode($this->title) ?>: <?= $model->username ?></h1>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'username',
                'email',
            ],
        ]) ?>

        <div class="form-group">
            <a class="btn btn-primary" href="<?= yii\helpers\Url::toRoute(['/user/profile/update']) ?>"><?= Module::t('module', 'VIEW_USER_UP') ?></a>
            <a class="btn btn-primary" href="<?= yii\helpers\Url::toRoute(['/user/profile/password-change']) ?>"><?= Module::t('module', 'VIEW_USER_UP_PASSWORD') ?></a>
        </div>

    </div>
</section>