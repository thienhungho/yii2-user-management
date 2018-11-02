<?php $form = \kartik\form\ActiveForm::begin(['id' => 'change-user-info', 'action' => ['change-user-info'] ]); ?>

<?= $form->field($changeUserInfoForm, 'username')->hiddenInput([
    'value' => Yii::$app->user->identity->username,
    'maxlength'   => true,
    'placeholder' => __t('app', 'Username'),
])->label(false) ?>

<?= $form->field($changeUserInfoForm, 'phone', [
    'addon' => ['prepend' => ['content' => '<span class="fa fa-phone"></span>']],
])->textInput([
    'maxlength'   => true,
    'placeholder' => __t('app', 'Phone'),
]) ?>

<?= $form->field($changeUserInfoForm, 'full_name', [
    'addon' => ['prepend' => ['content' => '<span class="fa fa-user"></span>']],
])->textInput([
    'maxlength'   => true,
    'placeholder' => __t('app', 'Full Name'),
]) ?>

<?= $form->field($changeUserInfoForm, 'facebook_url', [
    'addon' => ['prepend' => ['content' => '<span class="fa fa-facebook-official"></span>']],
])->textInput([
    'maxlength'   => true,
    'placeholder' => __t('app', 'Facebook Url'),
]) ?>

<?= $form->field($changeUserInfoForm, 'birth_date')->widget(\kartik\widgets\DatePicker::classname(), [
    'options' => ['placeholder' => __t('app', 'Choose Birth Date')],
    'pluginOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-mm-dd'
    ]
]); ?>

<?= $form->field($changeUserInfoForm, 'company', [
    'addon' => ['prepend' => ['content' => '<span class="fa fa-building"></span>']],
])->textInput([
    'maxlength'   => true,
    'placeholder' => __t('app', 'Company'),
]) ?>

<?= $form->field($changeUserInfoForm, 'tax_number', [
    'addon' => ['prepend' => ['content' => '<span class="fa fa-bank"></span>']],
])->textInput(['maxlength' => true, 'placeholder' => __t('app', 'Tax Number'),]) ?>

<?= $form->field($changeUserInfoForm, 'job', [
    'addon' => ['prepend' => ['content' => '<span class="fa fa-home"></span>']],
])->textInput(['maxlength' => true, 'placeholder' => __t('app', 'Job'),]) ?>

<?= $form->field($changeUserInfoForm, 'address', [
    'addon' => ['prepend' => ['content' => '<span class="fa fa-map-marker"></span>']],
])->textarea(['maxlength' => true, 'placeholder' => __t('app', 'Address'),]) ?>

<?= $form->field($changeUserInfoForm, 'bio', [
    'addon' => ['prepend' => ['content' => '<span class="fa fa-quote-left"></span>']],
])->textarea(['maxlength' => true, 'placeholder' => __t('app', 'Bio'),]) ?>

<div class="form-group">
    <?= \yii\helpers\Html::submitButton(__t('app', 'Change Account Infomation'), ['class' => 'btn green', 'name' => 'change-password-button']) ?>
    <?= \yii\helpers\Html::resetButton(__t('app', 'Cancel'), ['class' => 'btn default', 'name' => 'change-password-button']) ?>
</div>

<?php \kartik\form\ActiveForm::end(); ?>