<?php $form = \kartik\form\ActiveForm::begin([
    'id'     => 'change-password-form',
    'action' => ['change-password', 'id' => $model->id],
]); ?>

<?= $form->field($changePasswordForm, 'username')->hiddenInput(['value' => Yii::$app->user->identity->username])->label(false) ?>

<?= $form->field($changePasswordForm, 'new_password', [
    'addon' => ['prepend' => ['content' => '<span class="fa fa-lock"></span>']],
])->passwordInput([
    'maxlength'   => true,
    'placeholder' => t('app', 'New Password'),
    'value'       => '',
]) ?>

<?= $form->field($changePasswordForm, 're_new_password', [
    'addon' => ['prepend' => ['content' => '<span class="fa fa-lock"></span>']],
])->passwordInput([
    'maxlength'   => true,
    'placeholder' => t('app', 'Confirm Password'),
    'value'       => '',
]) ?>

    <div class="form-group">
        <?= \yii\helpers\Html::submitButton(t('app', 'Change Password'), [
            'class' => 'btn green',
            'name'  => 'change-password-button',
        ]) ?>
        <?= \yii\helpers\Html::resetButton(t('app', 'Cancel'), [
            'class' => 'btn default',
            'name'  => 'change-password-button',
        ]) ?>
    </div>

<?php \kartik\form\ActiveForm::end(); ?>