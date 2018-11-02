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