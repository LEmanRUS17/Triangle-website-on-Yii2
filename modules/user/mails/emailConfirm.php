<?php
use yii\helpers\Html;
use app\modules\user\Module;

/* @var $this yii\web\View */
/* @var $user app\modules\user\models\User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['user/default/email-confirm', 'token' => $user->email_confirm_token]);
?>

<?= Module::t('module', 'EMAIL_CONFIRM_GREETINGS' ) ?>, <?= Html::encode($user->username) ?>!

<?= Module::t('module', 'EMAIL_CONFIRM_ADDRESS' ) ?>:

<?= Html::a(Html::encode($confirmLink), $confirmLink) ?>

<?= Module::t('module', 'EMAIL_CONFIRM_FALSE_LETTER' ) ?>.