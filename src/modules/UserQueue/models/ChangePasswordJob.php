<?php

namespace thienhungho\UserManagement\modules\UserQueue\models;

use thienhungho\UserManagement\modules\UserBase\User;

/**
 * Class ChangePassword.
 */
class ChangePasswordJob extends \yii\base\BaseObject implements \yii\queue\JobInterface
{
    public $id;
    public $username;

    public $password;

    /**
     * @param \yii\queue\Queue $queue
     *
     * @throws \yii\base\Exception
     */
    public function execute($queue)
    {
        if (!empty($this->id)) {
            $user = User::find()->where(['id' => $this->id])
                ->one();
        } elseif (!empty($this->username)) {
            $user = User::findByUsername($this->username);
        }

        if (!empty($user)) {
            $user->setPassword($this->password);
            $user->save();
        }
    }
}
