<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "evento".
 *
 * @property integer $id_evento
 * @property string $data
 * @property string $hora
 * @property string $descricao
 * @property integer $id_disciplina
 * @property integer $id_usuario
 * @property string $nome
 * @property string $tipo
 *
 * @property Comentario[] $comentarios
 * @property Disciplina $idDisciplina
 * @property Notificacao[] $notificacaos
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
            [['data', 'hora', 'descricao', 'id_usuario', 'nome', 'tipo'], 'required', 'message' => 'Esse espaço deve ser preenchido '],
            [['data', 'hora'], 'safe'],
            [['id_disciplina', 'id_usuario'], 'integer'],
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
            'data' => 'Data',
            'hora' => 'Hora',
            'descricao' => 'Descricao',
            'id_disciplina' => 'Id Disciplina',
            'id_usuario' => 'Id Usuario',
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
}
