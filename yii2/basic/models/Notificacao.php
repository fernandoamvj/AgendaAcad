<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notificacao".
 *
 * @property integer $id_notificacao
 * @property integer $id_evento
 * @property string $data_hora_notificacao
 *
 * @property Evento $idEvento
 */
class Notificacao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notificacao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_evento', 'data_hora_notificacao'], 'required'],
            [['id_evento'], 'integer'],
            [['data_hora_notificacao'], 'safe'],
            [['id_evento'], 'exist', 'skipOnError' => true, 'targetClass' => Evento::className(), 'targetAttribute' => ['id_evento' => 'id_evento']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_notificacao' => 'Id Notificacao',
            'id_evento' => 'Id Evento',
            'data_hora_notificacao' => 'Data Hora Notificacao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEvento()
    {
        return $this->hasOne(Evento::className(), ['id_evento' => 'id_evento']);
    }
}
