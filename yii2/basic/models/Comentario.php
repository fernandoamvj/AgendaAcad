<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comentario".
 *
 * @property integer $id_comentario
 * @property integer $id_evento
 * @property integer $id_usuario
 * @property string $comentario
 * @property string $data_comentario
 *
 * @property Evento $idEvento
 * @property Usuario $idUsuario
 */
class Comentario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comentario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_evento', 'id_usuario'], 'required', 'message' => 'Esse espaço deve ser preenchido '],
            [['id_evento', 'id_usuario'], 'integer'],
            [['data_comentario'], 'safe'],
            [['comentario'], 'string', 'max' => 300],
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
            'id_comentario' => 'Id Comentario',
            'id_evento' => 'Id Evento',
            'id_usuario' => 'Id Usuario',
            'comentario' => 'Comentario',
            'data_comentario' => 'Data Comentario',
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
