<?php

namespace thienhungho\UserManagement\modules\UserBase\base;

use thienhungho\Block\models\Block;
use thienhungho\CommentManagement\models\Comment;
use thienhungho\PostManagement\models\ActiveQuery;
use thienhungho\PostManagement\models\Post;
use thienhungho\ProductManagement\models\Product;
use thienhungho\TermManagement\models\Term;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $full_name
 * @property string $job
 * @property string $bio
 * @property string $company
 * @property string $tax_number
 * @property string $address
 * @property string $avatar
 * @property string $phone
 * @property string $birth_date
 * @property string $facebook_url
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \thienhungho\UserManagement\modules\UserBase\Block[] $blocks
 * @property \thienhungho\UserManagement\modules\UserBase\Comment[] $comments
 * @property \thienhungho\UserManagement\modules\UserBase\Post[] $posts
 * @property \thienhungho\UserManagement\modules\UserBase\Product[] $products
 * @property \thienhungho\UserManagement\modules\UserBase\Term[] $terms
 */
class User extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'blocks',
            'comments',
            'posts',
            'products',
            'terms'
        ];
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
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['bio'], 'string'],
            [['birth_date'], 'safe'],
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'full_name', 'job', 'company', 'tax_number', 'address', 'avatar', 'phone', 'facebook_url'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique']
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
            'job' => Yii::t('app', 'Job'),
            'bio' => Yii::t('app', 'Bio'),
            'company' => Yii::t('app', 'Company'),
            'tax_number' => Yii::t('app', 'Tax Number'),
            'address' => Yii::t('app', 'Address'),
            'avatar' => Yii::t('app', 'Avatar'),
            'phone' => Yii::t('app', 'Phone'),
            'birth_date' => Yii::t('app', 'Birth Date'),
            'facebook_url' => Yii::t('app', 'Facebook Url'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlocks()
    {
        return $this->hasMany(Block::className(), ['author' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['author' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['author' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['author' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTerms()
    {
        return $this->hasMany(Term::className(), ['author' => 'id']);
    }

    /**
     * @return \thienhungho\UserManagement\modules\UserBase\query\UserQuery|\yii\db\ActiveQuery
     */
    public static function find()
    {
        return new \thienhungho\UserManagement\modules\UserBase\query\UserQuery(get_called_class());
    }
}
