<?php

namespace thienhungho\UserManagement\modules\UserProfile\models;

use thienhungho\UserManagement\modules\UserBase\User;
use Yii;
use yii\base\Model;

/**
 * Class ChangeAvatarForm
 * @package thienhungho\UserManagement\modules\UserProfile\models
 */
class ChangeAvatarForm extends Model
{
    public $avatar;
    public $username;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username'], 'required'],
            [['avatar'], 'file'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Username'),
            'avatar' => Yii::t('app', 'Avatar'),
        ];
    }

    /**
     * @return bool
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function changeAvatar()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            $avatar = $user->uploadAvatar('ChangeAvatarForm[avatar]');
            if (!empty($avatar)) {
                $user->avatar = $avatar;
            }
            if ($user->save()) {
                return true;
            } else {
                return false;
            }
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
