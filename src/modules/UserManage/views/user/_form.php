<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model thienhungho\UserManagement\modules\UserBase\User */
/* @var $form yii\widgets\ActiveForm */
$model->password_hash = '';

?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'username', [
        'addon' => ['prepend' => ['content' => '<span class="fa fa-user"></span>']],
    ])->textInput([
        'maxlength'   => true,
        'placeholder' => t('app', 'Username'),
    ]) ?>

    <?= $form->field($model, 'email', [
        'addon' => ['prepend' => ['content' => '<span class="fa fa-envelope"></span>']],
    ])->textInput([
        'maxlength'   => true,
        'placeholder' => t('app', 'Email'),
    ]) ?>

    <?= $form->field($model, 'phone', [
        'addon' => ['prepend' => ['content' => '<span class="fa fa-phone"></span>']],
    ])->textInput([
        'maxlength'   => true,
        'placeholder' => t('app', 'Phone'),
    ]) ?>

    <?= $form->field($model, 'full_name', [
        'addon' => ['prepend' => ['content' => '<span class="fa fa-user"></span>']],
    ])->textInput([
        'maxlength'   => true,
        'placeholder' => t('app', 'Full Name'),
    ]) ?>

    <?= $form->field($model, 'facebook_url', [
        'addon' => ['prepend' => ['content' => '<span class="fa fa-facebook-official"></span>']],
    ])->textInput([
        'maxlength'   => true,
        'placeholder' => t('app', 'Facebook Url'),
    ]) ?>

    <?= $form->field($model, 'birth_date')->widget(\kartik\widgets\DatePicker::classname(), [
        'options' => ['placeholder' => t('app', 'Choose Birth Date')],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]); ?>

    <?= $form->field($model, 'company', [
        'addon' => ['prepend' => ['content' => '<span class="fa fa-building"></span>']],
    ])->textInput([
        'maxlength'   => true,
        'placeholder' => t('app', 'Company'),
    ]) ?>

    <?= $form->field($model, 'tax_number', [
        'addon' => ['prepend' => ['content' => '<span class="fa fa-bank"></span>']],
    ])->textInput(['maxlength' => true, 'placeholder' => t('app', 'Tax Number'),]) ?>

    <?= $form->field($model, 'job', [
        'addon' => ['prepend' => ['content' => '<span class="fa fa-home"></span>']],
    ])->textInput(['maxlength' => true, 'placeholder' => t('app', 'Job'),]) ?>

    <?= $form->field($model, 'address', [
        'addon' => ['prepend' => ['content' => '<span class="fa fa-map-marker"></span>']],
    ])->textarea(['maxlength' => true, 'placeholder' => t('app', 'Address'),]) ?>

    <?= $form->field($model, 'bio', [
        'addon' => ['prepend' => ['content' => '<span class="fa fa-quote-left"></span>']],
    ])->textarea(['maxlength' => true, 'placeholder' => t('app', 'Bio'),]) ?>

    <?= $form->field($model, 'avatar')->fileInput()
        ->widget(\kartik\file\FileInput::classname(), [
            'options'       => ['accept' => 'image/*'],
            'pluginOptions' => empty($model->avatar) ? [] : [
                'initialPreview'       => [
                    '/' . $model->avatar,
                ],
                'initialPreviewAsData' => true,
                'initialCaption'       => $model->avatar,
                'overwriteInitial'     => true,
            ],
        ]);
    ?>

    <div class="form-group">
    <?php if(Yii::$app->controller->action->id != 'save-as-new'): ?>
        <?= Html::submitButton($model->isNewRecord ? t('app', 'Create') : t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?php endif; ?>
    <?php if(Yii::$app->controller->action->id != 'create'): ?>
        <?= Html::submitButton(t('app', 'Save As New'), ['class' => 'btn btn-info', 'value' => '1', 'name' => '_asnew']) ?>
    <?php endif; ?>
        <?= Html::a(t('app', 'Cancel'), request()->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
