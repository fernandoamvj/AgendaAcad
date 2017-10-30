<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "evento".
 *
 * @property integer $id_evento
 * @property string $data_hora
 * @property string $descricao
 * @property integer $id_disciplina
 * @property string $nome
 * @property string $tipo
 *
 * @property Comentario[] $comentarios
 * @property Disciplina $idDisciplina
 * @property Notificacao[] $notificacaos
 * @property Usuarioevento[] $usuarioeventos
 */
class Evento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'evento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_hora', 'nome', 'tipo'], 'required', 'message' => 'Esse espaço deve ser preenchido '],
            [['data_hora'], 'safe'],
            [['id_disciplina'], 'integer'],
            [['descricao'], 'string', 'max' => 300],
            [['nome', 'tipo'], 'string', 'max' => 45],
            [['id_disciplina'], 'exist', 'skipOnError' => true, 'targetClass' => Disciplina::className(), 'targetAttribute' => ['id_disciplina' => 'idDisciplina']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_evento' => 'Id Evento',
            'data_hora' => 'Data Hora',
            'descricao' => 'Descricao',
            'id_disciplina' => 'Id Disciplina',
            'nome' => 'Nome',
            'tipo' => 'Tipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentario::className(), ['id_evento' => 'id_evento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDisciplina()
    {
        return $this->hasOne(Disciplina::className(), ['idDisciplina' => 'id_disciplina']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotificacaos()
    {
        return $this->hasMany(Notificacao::className(), ['id_evento' => 'id_evento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioeventos()
    {
        return $this->hasMany(UsuarioEvento::className(), ['id_evento' => 'id_evento']);
    }
}
