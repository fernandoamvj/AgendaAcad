<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Comentario;

/**
 * ComentarioSearch represents the model behind the search form about `app\models\Comentario`.
 */
class ComentarioSearch extends Comentario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_comentario'], 'integer'],
            [['comentario', 'data_comentario', 'id_usuario', 'id_evento'], 'safe'],
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
        $query = Comentario::find();

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

        $query->joinWith('idUsuario');
        //$query->joinWith('idEvento');

        // grid filtering conditions
        $query->andFilterWhere([
            'id_comentario' => $this->id_comentario,
            'id_evento' => $this->id_evento,
            'id_usuario' => $this->id_usuario,
            'data_comentario' => $this->data_comentario,
        ]);

        $query->andFilterWhere(['like', 'comentario', $this->comentario]);

        $query->andFilterWhere(['like', 'usuario.nome', $this->id_usuario
        ]);
       $query->andFilterWhere(['like', 'evento.nome', $this->id_evento
        ]);

        return $dataProvider;
    }
}
