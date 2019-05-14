<?php
namespace thienhungho\UserManagement\models;

use Yii;
use yii\base\Model;

/**
 * Class ChangeAvatarForm
 * @package common\models
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
            ['avatar', 'file'],
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
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function changeAvatar()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            $avatar = $user->uploadAvatar('ChangeAvatarForm[avatar]');
            if (!empty($avatar)) {
                $user->avatar = $avatar;
            }
            $user->save();
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
