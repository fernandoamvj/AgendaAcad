<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarioevento".
 *
 * @property integer $id_usuario_evento
 * @property integer $id_evento
 * @property integer $id_usuario
 *
 * @property Evento $idEvento
 * @property Usuario $idUsuario
 */
class UsuarioEvento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuarioevento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_evento', 'id_usuario'], 'required'],
            [['id_evento', 'id_usuario'], 'integer'],
            [['id_evento'], 'exist', 'skipOnError' => true, 'targetClass' => Evento::className(), 'targetAttribute' => ['id_evento' => 'id_evento']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_usuario' => 'codigo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_usuario_evento' => 'Id Usuario Evento',
            'id_evento' => 'Id Evento',
            'id_usuario' => 'Id Usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEvento()
    {
        return $this->hasOne(Evento::className(), ['id_evento' => 'id_evento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(Usuario::className(), ['codigo' => 'id_usuario']);
    }
}
