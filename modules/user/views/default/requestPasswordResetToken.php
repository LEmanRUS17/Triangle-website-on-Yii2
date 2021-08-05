<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

//$this->params['breadcrumbs'][] = $this->title;
?>
<section id="request-password-reset-token">
    <div class="container site-request-password-reset">
        <h1 class="title"><?= Html::encode($this->title) ?></h1>

        <p>Пожалуйста, заполните вашу электронную почту. Ссылка для сброса пароля будет отправлена на веденый адрес. </p>

        <div class="row">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>