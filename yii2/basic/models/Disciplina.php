<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "disciplina".
 *
 * @property integer $idDisciplina
 * @property string $nome
 * @property integer $id_professor
 * @property integer $id_monitor
 *
 * @property Usuario $idMonitor
 * @property Usuario $idProfessor
 * @property Evento[] $eventos
 * @property Inscricao[] $inscricaos
 */
class Disciplina extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'disciplina';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idDisciplina', 'nome', 'id_professor', 'id_monitor'], 'required'],
            [['idDisciplina', 'id_professor', 'id_monitor'], 'integer'],
            [['nome'], 'string', 'max' => 45],
            [['id_monitor'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_monitor' => 'codigo']],
            [['id_professor'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_professor' => 'codigo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idDisciplina' => 'Id Disciplina',
            'nome' => 'Nome',
            'id_professor' => 'Id Professor',
            'id_monitor' => 'Id Monitor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMonitor()
    {
        return $this->hasOne(Usuario::className(), ['codigo' => 'id_monitor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProfessor()
    {
        return $this->hasOne(Usuario::className(), ['codigo' => 'id_professor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventos()
    {
        return $this->hasMany(Evento::className(), ['id_disciplina' => 'idDisciplina']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInscricaos()
    {
        return $this->hasMany(Inscricao::className(), ['id_disciplina' => 'idDisciplina']);
    }
}
