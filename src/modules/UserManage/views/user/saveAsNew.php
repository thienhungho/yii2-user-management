<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model thienhungho\UserManagement\modules\UserBase\User */

$this->title = t('app', 'Save As New {modelClass}: ', [
    'modelClass' => 'User',
]). ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => t('app', 'User'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = t('app', 'Save As New');
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
