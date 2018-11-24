<?php

namespace thienhungho\UserManagement\modules\UserSetting\query;

/**
 * This is the ActiveQuery class for [[\thienhungho\UserManagement\modules\UserSetting\query\UserSetting]].
 *
 * @see \thienhungho\UserManagement\modules\UserSetting\query\UserSetting
 */
class UserSettingQuery extends \thienhungho\ActiveQuery\models\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \thienhungho\UserManagement\modules\UserSetting\query\UserSetting[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \thienhungho\UserManagement\modules\UserSetting\query\UserSetting|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
