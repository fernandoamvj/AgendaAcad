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
            [['id_evento', 'data_hora', 'descricao', 'id_disciplina'], 'required'],
            [['id_evento', 'id_disciplina'], 'integer'],
            [['data_hora'], 'safe'],
            [['descricao'], 'string', 'max' => 300],
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
        ];
    }
}
