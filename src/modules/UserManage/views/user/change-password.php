<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model thienhungho\UserManagement\modules\UserBase\User */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('app', 'User'),
]) . ' @' . $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_change_password', [
        'changePasswordForm' => $changePasswordForm,
        'model' => $model,
    ]) ?>

</div>
