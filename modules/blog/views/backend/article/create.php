<?php

use yii\helpers\Html;
use app\modules\blog\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Article */

$this->title = Module::t('module', 'CREATE_ARTICLE_TITLE');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'INDEX_ARTICLE_TITLE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
