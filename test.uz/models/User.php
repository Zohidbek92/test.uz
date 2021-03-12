<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property int $gender
 * @property string $username
 * @property string $password
 * @property int $province
 * @property int $whois
 * @property string $auth_time
 * @property string $authKey
 * @property string $accessToken
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }
    public $password_repeat;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'gender', 'username', 'password', 'province', 'whois', 'password_repeat'], 'required'],
            ['username', 'unique'],
            [['province', 'whois'], 'integer'],
            [['auth_time'], 'safe'],
            [['firstname', 'lastname'], 'string', 'max' => 50, 'min' => 3],
            [['password', 'authKey', 'accessToken'], 'string'],
            [['password', 'username'], 'string', 'max' => 50, 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Ismni kiriting',
            'lastname' => 'Familyani kiriting',
            'gender' => 'Jinsingiz:',
            'username' => 'Login oling',
            'password' => 'Parol oling',
            'password_repeat' => 'Parolni takrorlang',
            'province' => 'Viloyatni tanlang',
            'whois' => 'Kimsiz?',
            'auth_time' => 'Auth Time',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
        ];
    }
    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['accessToken' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }
    public function getViloyat()
    {
        return $this->hasOne(Provinces::className(), ['id'=>'province']);
    }
    public function getKasb()
    {
        return $this->hasOne(Whois::className(), ['id'=>'whois']);
    }
}
