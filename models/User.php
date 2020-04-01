<?php

namespace app\models;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $authKey;
    public $accessToken;
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return self::findOne([
            'username' => $username
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        $encodePwd = $this->encodePassword($password);
        return $this->password === $encodePwd;
    }

    public function encodePassword($password)
    {
        return md5('#~!cnwt!~#'.$password);
    }

    public function getDepartments()
    {
        return $this->hasOne(Department::className(),['id' => 'department']);
    }
}
