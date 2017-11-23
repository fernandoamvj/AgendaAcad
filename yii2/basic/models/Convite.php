<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "convite".
 *
 * @property integer $id_convite
 * @property integer $id_evento
 * @property integer $id_usuario
 */
class Convite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'convite';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_evento', 'id_usuario'], 'required'],
            [['id_evento', 'id_usuario'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_convite' => 'Id Convite',
            'id_evento' => 'Id Evento',
            'id_usuario' => 'Id Usuário',
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
