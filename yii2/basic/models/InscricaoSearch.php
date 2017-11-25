<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Inscricao;

/**
 * InscricaoSearch represents the model behind the search form about `app\models\Inscricao`.
 */
class InscricaoSearch extends Inscricao
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'id_usuario'], 'integer'],
            [['id_disciplina'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Inscricao::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith('idDisciplina');

        // grid filtering conditions
        $query->andFilterWhere([
            'codigo' => $this->codigo,
            'id_usuario' => $this->id_usuario,
            'id_disciplina' => $this->id_disciplina,
            'id_semestre' => $this->id_semestre,
        ]);

        $query->andFilterWhere(['like', 'disciplina.nome_disciplina', $this->id_disciplina
        ]);

        return $dataProvider;
    }
}
