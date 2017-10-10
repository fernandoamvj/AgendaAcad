<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "evento".
 *
 * @property integer $id_evento
 * @property string $data_hora
 * @property string $descrição
 * @property integer $id_disciplina
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
            [['id_evento', 'data_hora', 'descrição'], 'required'],
            [['id_evento', 'id_disciplina'], 'integer'],
            [['data_hora'], 'safe'],
            [['descrição'], 'string', 'max' => 300],
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
            'descrição' => 'Descrição',
            'id_disciplina' => 'Id Disciplina',
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
        return $this->hasMany(Usuarioevento::className(), ['id_evento' => 'id_evento']);
    }
}
