<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notificacao".
 *
 * @property integer $id_notificacao
 * @property string $data_hora_notificacao
 * @property integer $id_usuario
 *
 * @property Usuario $idUsuario
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
            [['id_usuario'], 'required'],
            [['id_usuario'], 'integer'],
            [['data_hora_notificacao'], 'string', 'max' => 20],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_usuario' => 'codigo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_notificacao' => 'Id Notificacao',
            'data_hora_notificacao' => 'Período de antecedência',
            'id_usuario' => 'Id Usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(Usuario::className(), ['codigo' => 'id_usuario']);
    }
}
