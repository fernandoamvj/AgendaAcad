<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 09/10/2017
 * Time: 20:33
 */

namespace app\models;


use yii\base\Model;

class CadastroModel extends Model
{
    public $nome;
    public $email;
    public $idade;

    public function rules()
    {
        return[
          [['nome','email','idade'], 'required'],
          ['email', 'email'],
          ['idade', 'number', 'integerOnly'=>true]
        ];
    }

    public function attributeLabels()
    {
        return [
            'nome' => 'Nome completo',
            'email' => 'E-mail',
            'idade' => 'Idade'
        ];
    }
}