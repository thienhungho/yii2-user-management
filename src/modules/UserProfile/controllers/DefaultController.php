<?php

namespace thienhungho\UserManagement\modules\UserProfile\controllers;

use thienhungho\UserManagement\modules\UserBase\User;
use thienhungho\UserManagement\modules\UserProfile\models\ChangeAvatarForm;
use thienhungho\UserManagement\modules\UserProfile\models\ChangePasswordForm;
use thienhungho\UserManagement\modules\UserProfile\models\ChangeUserInfoForm;
use thienhungho\UserManagement\modules\UserProfile\models\ChangeUserSettingForm;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Default controller for the `UserProfile` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', self::buildParams());
    }

    /**
     * @return array
     */
    protected function buildParams()
    {
        $user = User::findByUsername(\Yii::$app->user->identity->username);
        $changePasswordForm = new ChangePasswordForm();
        $changeAvatarForm = new ChangeAvatarForm();
        $changeUserInfoForm = new ChangeUserInfoForm();
        $changeUserSettingForm = new ChangeUserSettingForm();
        $changeUserInfoForm->phone = \Yii::$app->user->identity->phone;
        $changeUserInfoForm->address = \Yii::$app->user->identity->address;
        $changeUserInfoForm->full_name = \Yii::$app->user->identity->full_name;
        $changeUserInfoForm->birth_date = \Yii::$app->user->identity->birth_date;
        $changeUserInfoForm->facebook_url = \Yii::$app->user->identity->facebook_url;
        $changeUserInfoForm->company = \Yii::$app->user->identity->company;
        $changeUserInfoForm->tax_number = \Yii::$app->user->identity->tax_number;
        $changeUserInfoForm->bio = \Yii::$app->user->identity->bio;
        $changeUserInfoForm->job = \Yii::$app->user->identity->job;

        return [
            'user'                  => $user,
            'changePasswordForm'    => $changePasswordForm,
            'changeAvatarForm'      => $changeAvatarForm,
            'changeUserInfoForm'    => $changeUserInfoForm,
            'changeUserSettingForm' => $changeUserSettingForm,
        ];
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionChangeUserInfo()
    {
        $model = new ChangeUserInfoForm();
        if ($model->load(\request()->post())) {
            if ($model->changeInfo()) {
                set_flash_has_been_saved();
            } else {
                set_flash_has_not_been_saved();
                $params = self::buildParams();
                $params['changeUserInfoForm'] = $model;
                return $this->render('index', $params);
            }
        }

        return $this->redirect(Url::to(['index']));
    }

    /**
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionChangePassword()
    {
        $model = new ChangePasswordForm();
        if ($model->load(request()->post())) {
            if ($model->changePassword()) {
                set_flash_has_been_saved();
            } else {
                set_flash_has_not_been_saved();
                $params = self::buildParams();
                $params['changePasswordForm'] = $model;
                return $this->render('index', $params);
            }
        }

        return $this->redirect(Url::to(['index']));
    }

    /**
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function actionChangeAvatar()
    {
        $model = new ChangeAvatarForm();
        if ($model->load(request()->post())) {
            if ($model->changeAvatar()) {
                set_flash_has_been_saved();
            } else {
                set_flash_has_not_been_saved();
                $params = self::buildParams();
                $params['changeAvatarForm'] = $model;
                return $this->render('index', $params);
            }
        }

        return $this->redirect(Url::to(['index']));
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionChangeSetting()
    {
        $model = new ChangeUserSettingForm();
        if ($model->load(request()->post())) {
            if ($model->changeSettings()) {
                set_flash_has_been_saved();
            } else {
                set_flash_has_not_been_saved();
                $params = self::buildParams();
                $params['changeUserSettingForm'] = $model;
                return $this->render('index', $params);
            }
        }

        return $this->redirect(Url::to(['index']));
    }
}
