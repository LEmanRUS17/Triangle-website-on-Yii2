<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use app\modules\user\Module;

$this->title = Module::t('module', 'TITLE_LOGIN'); // Заголовок страницы
//$this->params['breadcrumbs'][] = $this->title;
?>
<section id="login">
    <div class="container site-login">
        <h1 class="title"><?= Html::encode($this->title) ?></h1>
        <p><?= Module::t('module', 'LOGIN_TEXT_ENTRY_FIELD'); ?></p>

        <div class="row">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['class' => '']]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div style="color:#999;margin:1em 0">
                    <a href="<?= Url::toRoute(['default/password-reset-request']) ?>"><?= Module::t('module', 'LOGIN_RECOVERY_PASSWORD') ?></a>.
                   <!--
                    <br>
                    Требуется новое письмо с подтверждением? <a href="<?//= Url::toRoute(['default/email-confirm']) ?>">Отправить повторно</a>.
                    -->
                </div>

                <div class="form-group">
                    <?= Html::submitButton( Module::t('module', 'LOGIN_BUTTON'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
</section>