<?php

namespace app\models;

use app\models\UsuarioSearch as UsuarioSearch;


class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $codigo;
    public $nome;
    public $email;
    public $tipo;
    public $senha;
    public $authKey;
    public $accessToken;

    /**
     * @inheritdoc
     */
    public static function findIdentity($codigo)
    {

        $user = UsuarioSearch::find()->where(['codigo' => $codigo])->one();
  
        if($user){
            return new static($user);
        }
  
        return null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
 
        $user = UsuarioSearch::find()->where(['email' => $email])->one();

        if($user){
            return new static($user);
        }

        return null;
    }


    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->codigo;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        //return $this->authKey;
        return null;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        // return $this->authKey === $authKey;
        return null;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($senha)
    {
        return $this->senha === $senha;
    }
}
