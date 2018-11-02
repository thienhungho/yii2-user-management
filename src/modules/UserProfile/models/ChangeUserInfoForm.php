<?php
namespace thienhungho\UserManagement\modules\UserProfile\models;

use thienhungho\UserManagement\modules\UserBase\User;
use Yii;
use yii\base\Model;

/**
 * Login form
 */
class ChangeUserInfoForm extends Model
{
    public $username;
    public $phone;
    public $full_name;
    public $facebook_url;
    public $birth_date;
    public $company;
    public $tax_number;
    public $address;
    public $bio;
    public $job;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username'], 'required'],
            [['bio'], 'string'],
            [['birth_date'], 'safe'],
            [['full_name', 'job', 'company', 'tax_number', 'address', 'phone', 'facebook_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'full_name' => Yii::t('app', 'Full Name'),
            'company' => Yii::t('app', 'Company'),
            'tax_number' => Yii::t('app', 'Tax Number'),
            'address' => Yii::t('app', 'Address'),
            'job' => Yii::t('app', 'Job'),
            'avatar' => Yii::t('app', 'Avatar'),
            'phone' => Yii::t('app', 'Phone'),
            'birth_date' => Yii::t('app', 'Birth Date'),
            'facebook_url' => Yii::t('app', 'Facebook Url'),
            'status' => Yii::t('app', 'Status'),
            'bio' => Yii::t('app', 'Bio'),
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function changeInfo()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            $user->full_name = $this->full_name;
            $user->company = $this->company;
            $user->tax_number = $this->tax_number;
            $user->address = $this->address;
            $user->job = $this->job;
            $user->phone = $this->phone;
            $user->birth_date = $this->birth_date;
            $user->facebook_url = $this->facebook_url;
            $user->bio = $this->bio;
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
