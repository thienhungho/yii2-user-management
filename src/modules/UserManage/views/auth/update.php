<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\auth\AuthItem */

$this->title = t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Auth Item',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => t('app', 'Auth Item'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = t('app', 'Update');
?>
<div class="auth-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
