<?php
namespace thienhungho\UserManagement\modules\UserProfile\models;

use thienhungho\UserManagement\modules\UserBase\User;
use thienhungho\UserManagement\modules\UserQueue\models\ChangePasswordJob;
use Yii;
use yii\base\Model;

/**
 * Login form
 */
class ChangePasswordForm extends Model
{
    public $password;
    public $new_password;
    public $re_new_password;
    public $username;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['password', 'new_password', 're_new_password', 'username'], 'required'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            ['new_password', 'validatePassword'],
            ['re_new_password', 'validatePassword'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'new_password' => Yii::t('app', 'New Password'),
            're_new_password' => Yii::t('app', 'Confirm Password')
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t('app', 'Incorrect password.'));
            }
        }
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateReNewPassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if ($this->new_password != $this->re_new_password) {
                $this->addError($attribute, Yii::t('app', 'Confirm new password error.'));
            }
        }
    }

    /**
     * @return bool
     * @throws \yii\base\Exception
     */
    public function changePassword()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            $user->setPassword($this->new_password);
            return $user->save();
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
