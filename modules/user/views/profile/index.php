<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

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

    </div>
</section>