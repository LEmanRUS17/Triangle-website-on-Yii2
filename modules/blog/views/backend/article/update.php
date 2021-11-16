<?php

use yii\helpers\Html;
use app\modules\blog\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Article */

$this->title = Module::t('module', 'UPDATE_ARTICLE_TITLE') . ': ' . "$model->title";
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'INDEX_ARTICLE_TITLE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('module', 'UPDATE_ARTICLE_TITLE');
?>
<div class="article-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
