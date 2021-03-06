<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inscricao".
 *
 * @property integer $codigo
 * @property integer $id_disciplina
 * @property integer $id_usuario
 * @property integer $id_semestre
 *
 * @property Disciplina $idDisciplina
 * @property Usuario $idUsuario
 */
class Inscricao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inscricao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_disciplina', 'id_usuario', 'id_semestre'], 'required'],
            [['id_disciplina', 'id_usuario', 'id_semestre'], 'integer'],
            [['id_disciplina'], 'exist', 'skipOnError' => true, 'targetClass' => Disciplina::className(), 'targetAttribute' => ['id_disciplina' => 'idDisciplina']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_usuario' => 'codigo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'id_disciplina' => 'Nome da Disciplina',
            'id_usuario' => 'Id Usuario',
            'id_semestre' => 'Semestre',
        ];
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
    public function getIdUsuario()
    {
        return $this->hasOne(Usuario::className(), ['codigo' => 'id_usuario']);
    }
}
