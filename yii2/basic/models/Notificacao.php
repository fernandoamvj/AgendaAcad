<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notificacao".
 *
 * @property integer $id_usuario
 * @property string $periodo_antecedencia
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
            [['id_notificacao', 'id_usuario', 'periodo_antecedencia'], 'required'],
            [['id_notificacao', 'id_usuario'], 'integer'],
            [['periodo_antecedencia'], 'safe'],
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
            'id_usuario' => 'Id Usuario',
            'periodo_antecedencia' => 'Período de Antecedência',
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
