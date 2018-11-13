<?php
namespace thienhungho\UserManagement\modules\UserManage;

use thienhungho\UserManagement\models\User;
use Yii;
use yii\base\Model;

/**
 * Login form
 */
class CreateUserForm extends Model
{
    public $id;
    public $email;
    public $username;
    public $password;
    public $phone;
    public $full_name;
    public $facebook_url;
    public $birth_date;
    public $company;
    public $tax_number;
    public $address;
    public $bio;
    public $job;
    public $role;
    public $status;
    public $avatar;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => User::STATUS_ACTIVE],
            ['status', 'in', 'range' => [User::STATUS_ACTIVE, User::STATUS_DELETED]],
            [['username', 'password', 'email'], 'required'],
            [['bio'], 'string'],
            ['avatar', 'file'],
            [['birth_date'], 'safe'],
            [['username', 'email', 'full_name', 'job', 'company', 'tax_number', 'address', 'phone', 'facebook_url', 'password'], 'string', 'max' => 255],
            [['username'], 'unique', 'targetClass' => '\thienhungho\UserManagement\models\User', 'message' => t('app', 'This username has already been taken.')],
            [['email'], 'unique', 'targetClass' => '\thienhungho\UserManagement\models\User', 'message' => t('app', 'This email has already been taken.')],
            [['email'], 'email'],
            ['avatar', 'default', 'value' => User::DEFAULT_AVATAR],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => t('app', 'ID'),
            'username' => t('app', 'Username'),
            'auth_key' => t('app', 'Auth Key'),
            'password' => t('app', 'Password'),
            'password_hash' => t('app', 'Password Hash'),
            'password_reset_token' => t('app', 'Password Reset Token'),
            'email' => t('app', 'Email'),
            'full_name' => t('app', 'Full Name'),
            'company' => t('app', 'Company'),
            'tax_number' => t('app', 'Tax Number'),
            'address' => t('app', 'Address'),
            'job' => t('app', 'Job'),
            'avatar' => t('app', 'Avatar'),
            'phone' => t('app', 'Phone'),
            'birth_date' => t('app', 'Birth Date'),
            'facebook_url' => t('app', 'Facebook Url'),
            'status' => t('app', 'Status'),
            'bio' => t('app', 'Bio'),
        ];
    }

    /**
     * @return bool|User
     * @throws \yii\base\Exception
     */
    public function create()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->full_name = $this->full_name;
            $user->phone = $this->phone;
            $user->facebook_url = $this->facebook_url;
            $user->birth_date = $this->birth_date;
            $user->company = $this->company;
            $user->job = $this->job;
            $user->tax_number = $this->tax_number;
            $user->address = $this->address;
            $user->bio = $this->bio;
            $user->avatar = $this->avatar;
            $user->status = $this->status;

            if ($user->save()) {
                $auth = Yii::$app->authManager;
                $courier = $auth->getRole('user');
                $auth->assign($courier, $user->primaryKey);
                return $user;
            }
            return false;
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
