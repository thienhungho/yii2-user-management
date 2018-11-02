<?php

namespace thienhungho\UserManagement\modules\UserSetting\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "{{%user_setting}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $section
 * @property string $key
 * @property string $value
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property \thienhungho\UserManagement\modules\UserSetting\User $user
 */
class UserSetting extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'user'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'section', 'key'], 'required'],
            [['user_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['section', 'key', 'value'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_setting}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'section' => Yii::t('app', 'Section'),
            'key' => Yii::t('app', 'Key'),
            'value' => Yii::t('app', 'Value'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\thienhungho\UserManagement\modules\UserSetting\User::className(), ['id' => 'user_id']);
    }
    
    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }


    /**
     * @inheritdoc
     * @return \thienhungho\UserManagement\modules\UserSetting\query\UserSettingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \thienhungho\UserManagement\modules\UserSetting\query\UserSettingQuery(get_called_class());
    }
}
