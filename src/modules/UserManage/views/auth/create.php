<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\auth\AuthItem */

$this->title = t('app', 'Create Auth Item');
$this->params['breadcrumbs'][] = ['label' => t('app', 'Auth Item'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
