<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

//$this->params['breadcrumbs'][] = $this->title;
?>
<section id="login">
    <div class="container site-login">
        <h1 class="title"><?= Html::encode($this->title) ?></h1>
        <p>Пожалуйста, заполните следующие поля для входа:</p>

        <div class="row">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-1 control-label'],
                    ],
                ]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div style="color:#999;margin:1em 0">
                    <a href="<?= Url::toRoute(['default/password-reset-request']) ?>"><?= Yii::t('app', 'LOGIN_RECOVERY_PASSWORD') ?></a>.
                   <!--
                    <br>
                    Требуется новое письмо с подтверждением? <a href="<?//= Url::toRoute(['default/email-confirm']) ?>">Отправить повторно</a>.
                    -->
                </div>

                <div class="form-group">
                    <?= Html::submitButton( Yii::t('app', 'LOGIN_BUTTON'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
</section>