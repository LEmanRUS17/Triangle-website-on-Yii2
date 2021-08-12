<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'TITLE_PROFILE'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>

<section id="user-profile-update">
    <div class="container user-profile-update">

        <h1 class="title"><?= Html::encode($this->title) ?><!--: <?//= $model->username ?>--></h1>

        <div class="user-form">
            <?php $form = ActiveForm::begin([]); ?>

            <?= $form->field($model, 'email')->input('email', ['maxlength' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'UP_USER_BUTTON_SAVE'), ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>
