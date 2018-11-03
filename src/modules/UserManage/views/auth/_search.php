<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model thienhungho\UserManagement\modules\UserManage\search\AuthSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-auth-item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <?= $form->field($model, 'type')->textInput(['placeholder' => 'Type']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'rule_name')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\modules\auth\AuthRule::find()->orderBy('name')->asArray()->all(), 'name', 'name'),
        'options' => ['placeholder' => t('app', 'Choose Auth rule')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'data')->textInput(['placeholder' => 'Data']) ?>

    <div class="form-group">
        <?= Html::submitButton(t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
