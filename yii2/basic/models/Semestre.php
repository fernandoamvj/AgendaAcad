<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "semestre".
 *
 * @property integer $id_semestre
 * @property string $data_fim
 * @property string $nome
 */
class Semestre extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'semestre';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_fim', 'nome'], 'required'],
            [['data_fim'], 'safe'],
            [['nome'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_semestre' => 'Id Semestre',
            'data_fim' => 'Data Fim',
            'nome' => 'Nome',
        ];
    }
}
