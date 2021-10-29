<?php

use yii\helpers\Html;
use app\modules\admin\Module;

/* @var $this yii\web\View */
/* @var $model \app\modules\user\models\User */

//$this->title = Yii::t('app', 'ADMIN');
//$this->params['breadcrumbs'][] = $this->title;

$this->title = Module::t('module', 'TITLE_ADMIN');

?>
<section id="admin-index">
    <div class="container admin-default-index">
        <h1 class="title"><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a(Module::t('module', 'ADMIN_USERS'), ['/user/default/index'], ['class' => 'btn btn-primary']) ?>
        </p>
    </div>
</section>