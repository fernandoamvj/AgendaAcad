<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property string $nome
 * @property string $email
 * @property integer $tipo
 * @property string $senha
 *
 * @property Disciplina[] $disciplinas
 * @property Disciplina[] $disciplinas0
 * @property Tipousuario $tipo0
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'email', 'tipo', 'senha'], 'required'],
            [['tipo'], 'integer'],
            [['nome'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 45],
            [['senha'], 'string', 'max' => 32],
            [['tipo'], 'exist', 'skipOnError' => true, 'targetClass' => Tipousuario::className(), 'targetAttribute' => ['tipo' => 'id_tipo_usuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nome' => 'Nome',
            'email' => 'Email',
            'tipo' => 'Tipo',
            'senha' => 'Senha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisciplinas()
    {
        return $this->hasMany(Disciplina::className(), ['monitor' => 'nome']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisciplinas0()
    {
        return $this->hasMany(Disciplina::className(), ['criada_por' => 'nome']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipo0()
    {
        return $this->hasOne(Tipousuario::className(), ['id_tipo_usuario' => 'tipo']);
    }
}
