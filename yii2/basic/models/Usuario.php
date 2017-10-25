<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property integer $codigo
 * @property string $nome
 * @property string $email
 * @property integer $tipo
 * @property string $senha
 *
 * @property Comentario[] $comentarios
 * @property Disciplina[] $disciplinas
 * @property Disciplina[] $disciplinas0
 * @property Inscricao[] $inscricaos
 * @property Tipousuario $tipo0
 * @property Usuarioevento[] $usuarioeventos
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
            [['codigo', 'tipo'], 'integer'],
            [['nome'], 'string', 'max' => 50],
            [['email'], 'email'],
            [['senha'], 'string', 'max' => 32],
            [['tipo'], 'exist', 'skipOnError' => true, 'targetClass' => TipoUsuario::className(), 'targetAttribute' => ['tipo' => 'id_tipo_usuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'nome' => 'Nome',
            'email' => 'Email',
            'tipo' => 'Tipo',
            'senha' => 'Senha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentario::className(), ['id_usuario' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisciplinas()
    {
        return $this->hasMany(Disciplina::className(), ['id_monitor' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisciplinas0()
    {
        return $this->hasMany(Disciplina::className(), ['id_professor' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInscricaos()
    {
        return $this->hasMany(Inscricao::className(), ['id_usuario' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipo0()
    {
        return $this->hasOne(TipoUsuario::className(), ['id_tipo_usuario' => 'tipo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioeventos()
    {
        return $this->hasMany(UsuarioEvento::className(), ['id_usuario' => 'codigo']);
    }
}
