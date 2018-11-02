<?php
namespace thienhungho\UserManagement\modules\UserProfile\models;

use thienhungho\UserManagement\modules\UserBase\User;
use Yii;
use yii\base\Model;

/**
 * Login form
 */
class ChangeUserSettingForm extends Model
{

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email_notification_when_user_login'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email_notification_when_user_login' => Yii::t('app', 'Email Notification on when user login'),
        ];
    }

    /**
     * @return bool
     */
    public function changeSettings()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            return true;
        }

        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
