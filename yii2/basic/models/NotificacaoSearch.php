<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Notificacao;

/**
 * NotificacaoSearch represents the model behind the search form about `app\models\Notificacao`.
 */
class NotificacaoSearch extends Notificacao
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario'], 'integer'],
            [['periodo_antecedencia'], 'safe'],
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
        $query = Notificacao::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id_usuario' => $this->id_usuario,
        ]);

        $query->andFilterWhere(['like', 'periodo_antecedencia', $this->periodo_antecedencia]);

        return $dataProvider;
    }
}
