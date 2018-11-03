<?php $form = \kartik\form\ActiveForm::begin(['id' => 'change-avatar-form', 'action' => ['change-avatar'] ]); ?>

<?= $form->field($changeAvatarForm, 'username')->hiddenInput(['value' => Yii::$app->user->identity->username])->label(false) ?>

<?= $form->field($changeAvatarForm, 'avatar')->fileInput()
    ->widget(\kartik\file\FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
    ]);
?>

<div class="form-group">
    <?= \yii\helpers\Html::submitButton(t('app', 'Change Avatar'), ['class' => 'btn green', 'name' => 'change-password-button']) ?>
    <?= \yii\helpers\Html::resetButton(t('app', 'Cancel'), ['class' => 'btn default', 'name' => 'change-password-button']) ?>
</div>

<?php \kartik\form\ActiveForm::end(); ?>