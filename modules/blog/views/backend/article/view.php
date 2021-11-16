<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\blog\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'INDEX_ARTICLE_TITLE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('module', 'VIEW_UPDATE'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Module::t('module', 'VIEW_DELETE'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Module::t('module', 'VIEW_DELETE_MESSAGE'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description',
            'date',
            'viewed',
            'status',
            'category_id',
            'content',
        ],
    ]) ?>

</div>
