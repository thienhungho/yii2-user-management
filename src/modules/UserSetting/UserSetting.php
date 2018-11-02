<?php

namespace thienhungho\UserManagement\modules\UserSetting;

use Yii;
use \thienhungho\UserManagement\modules\UserSetting\base\UserSetting as BaseUserSetting;

/**
 * This is the model class for table "user_setting".
 */
class UserSetting extends BaseUserSetting
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['user_id', 'section', 'key'], 'required'],
            [['user_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['section', 'key', 'value'], 'string', 'max' => 255]
        ]);
    }
	
}
