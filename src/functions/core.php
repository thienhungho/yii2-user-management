<?php
/**
 * @param $roles
 * @param null $user
 *
 * @return bool
 */
function is_role($roles, $user = null)
{
    if ($user == null) {
        if (is_login()) {
            $user_roles = Yii::$app->user->identity->role;
        } else {
            return false;
        }
    } else {
        $user_roles = $user->role;
    }

    if (is_array($roles)) {
        foreach ($roles as $role) {
            if (in_array($role, $user_roles)) {
                return true;
            }
        }
    } else {
        return (in_array($roles, $user_roles));
    }

    return false;
}

/**
 * @return bool
 */
function is_login()
{
    return !Yii::$app->user->isGuest;
}

/**
 * @return null
 */
function current_user()
{
    if (is_login()) {
        return Yii::$app->user;
    }

    return null;
}

/**
 * @return int|string
 */
function get_current_user_id()
{
    if (is_login()) {
        return Yii::$app->user->id;
    }

    return null;
}

/**
 * @return null
 */
function get_current_user_name()
{
    if (is_login()) {
        return Yii::$app->user->identity->username;
    }

    return null;
}

/**
 * @return null
 */
function get_current_user_email()
{
    if (is_login()) {
        return Yii::$app->user->identity->email;
    }

    return null;
}

/**
 * @return mixed
 */
function get_current_user_avatar()
{
    if (is_login()) {
        return Yii::$app->user->identity->avatar;
    }

    return null;
}

/**
 * @param $user_id
 * @param $section
 * @param $key
 * @param $default
 *
 * @return mixed
 */
function get_user_setting_value($user_id, $section, $key, $default)
{
    $userSetting = \thienhungho\UserManagement\modules\UserSetting\UserSetting::find()
        ->select('value')
        ->where(['user_id' => $user_id])
        ->andWhere(['section' => $section])
        ->andWhere(['key' => $key])
        ->asArray()
        ->one();
    return empty($userSetting) ? $default : $userSetting['value'];
}

/**
 * @param $section
 * @param $key
 * @param $default
 *
 * @return mixed
 */
function get_current_user_setting_value($section, $key, $default)
{
    if (is_login()) {
        return get_user_setting_value(get_current_user_id(), $section, $key, $default);
    } else {
        return $default;
    }
}

/**
 * @param $user_id
 * @param $section
 * @param $key
 * @param $value
 *
 * @return bool
 *
 */
function set_user_setting($user_id, $section, $key, $value)
{
    $user_setting = new \thienhungho\UserManagement\modules\UserSetting\UserSetting([
        'user_id' => $user_id,
        'section' => $section,
        'key' => $key,
        'value' => $value
    ]);
    return $user_setting->save();
}

/**
 * @param $section
 * @param $key
 * @param $value
 *
 * @return bool
 */
function set_current_user_setting($section, $key, $value)
{
    return set_user_setting(get_current_user_id(), $section, $key, $value);
}

/**
 * @param $id
 * @return array|\thienhungho\UserManagement\models\User|\thienhungho\UserManagement\modules\UserBase\query\User|\yii\db\ActiveRecord|null
 */
function get_user_by_id($id) {
    return \thienhungho\UserManagement\models\User::find()
        ->where(['id' => $id])
        ->one();
}

/**
 * @param $username
 * @return array|\thienhungho\UserManagement\models\User|\thienhungho\UserManagement\modules\UserBase\query\User|\yii\db\ActiveRecord|null
 */
function get_user_by_username($username) {
    return \thienhungho\UserManagement\models\User::find()
        ->where(['username' => $username])
        ->one();
}

/**
 * @param $email
 * @return array|\thienhungho\UserManagement\models\User|\thienhungho\UserManagement\modules\UserBase\query\User|\yii\db\ActiveRecord|null
 */
function get_user_by_email($email) {
    return \thienhungho\UserManagement\models\User::find()
        ->where(['email' => $email])
        ->one();
}