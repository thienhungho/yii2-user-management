<?php
namespace thienhungho\UserManagement\models;

use thienhungho\UserManagement\models\User;
use Yii;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\thienhungho\UserManagement\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'There is no user with this email address.'
            ],
        ];
    }

    /**
     * @return \BaseApp\mail\modules\Mail\Mailer|bool
     * @throws \yii\base\InvalidConfigException
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if (!$user) {
            return false;
        }
        
        if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }

        return send_mail(
            'no-reply',
            get_app_name(),
            $this->email,
            'Password reset for ' . Yii::$app->name,
            t('app', 'Request Password'),
            'html',
            '/mail/user/request-password',
            [
                'title' => 'Password reset for ' . Yii::$app->name,
                'user' => $user
            ]
        );
    }
}
