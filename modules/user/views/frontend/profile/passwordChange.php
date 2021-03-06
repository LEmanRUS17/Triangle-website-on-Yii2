<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\modules\user\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\ChangePasswordForm */

//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'TITLE_PROFILE'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
$this->title = Module::t('module', 'TITLE_PASSWORD_CHANGE');
?>
<section id="user-profile-update">
    <div class="container user-profile-password-change">

        <h1 class="title"><?= Html::encode($this->title) ?></h1>

        <div class="user-form">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'currentPassword')->passwordInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'newPassword')->passwordInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'newPasswordRepeat')->passwordInput(['maxlength' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton(Module::t('module', 'UP_USER_PASSWORD_BUTTON_SAVE'), ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>

    </div>
</section>