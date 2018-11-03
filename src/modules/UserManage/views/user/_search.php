<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model thienhungho\UserManagement\modules\UserManage\search\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => 'Username']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email']) ?>

    <?php /* echo $form->field($model, 'full_name')->textInput(['maxlength' => true, 'placeholder' => 'Full Name']) */ ?>

    <?php /* echo $form->field($model, 'job')->textInput(['maxlength' => true, 'placeholder' => 'Job']) */ ?>

    <?php /* echo $form->field($model, 'bio')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field($model, 'company')->textInput(['maxlength' => true, 'placeholder' => 'Company']) */ ?>

    <?php /* echo $form->field($model, 'tax_number')->textInput(['maxlength' => true, 'placeholder' => 'Tax Number']) */ ?>

    <?php /* echo $form->field($model, 'address')->textInput(['maxlength' => true, 'placeholder' => 'Address']) */ ?>

    <?php /* echo $form->field($model, 'avatar')->textInput(['maxlength' => true, 'placeholder' => 'Avatar']) */ ?>

    <?php /* echo $form->field($model, 'phone')->textInput(['maxlength' => true, 'placeholder' => 'Phone']) */ ?>

    <?php /* echo $form->field($model, 'birth_date')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => t('app', 'Choose Birth Date'),
                'autoclose' => true
            ]
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'facebook_url')->textInput(['maxlength' => true, 'placeholder' => 'Facebook Url']) */ ?>

    <?php /* echo $form->field($model, 'status')->textInput(['placeholder' => 'Status']) */ ?>

    <div class="form-group">
        <?= Html::submitButton(t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
