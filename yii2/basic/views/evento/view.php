<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Disciplina;
/* @var $this yii\web\View */
/* @var $model app\models\Evento */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>

        <?php
        if($model->idDisciplina == null)
            $exibir_botoes = true;
        else
            if( Disciplina::findOne(['idDisciplina' => $model->id_disciplina])->id_monitor == Yii::$app->user->identity->codigo ||
                Disciplina::findOne(['idDisciplina' => $model->id_disciplina])->id_professor == Yii::$app->user->identity->codigo) {

                $exibir_botoes = true;
            } else {
                $exibir_botoes = false;
            }
        ?>

        <?php
        //checa se o usuario tem permissao pra editar evento
        if($exibir_botoes)
            echo Html::a('Atualizar informações', ['update', 'id' => $model->id_evento], ['class' => 'btn btn-primary']);
        ?>

        <?php
        //checa se o usuario tem permissao pra excluir evento
        if($exibir_botoes)
            echo Html::a('Excluir', ['delete', 'id' => $model->id_evento], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Tem certeza de que quer excluir?',
                    'method' => 'post',
                ],
        ]);
        ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nome',
            'descricao',
            'data',
            'hora',
            [
                'label' => 'Discplina',
                'attribute'=>'idDisciplina.nome_disciplina'
            ],
            [
                'label' => 'Criador',
                'attribute'=>'idUsuario.nome',
            ],
        ],
    ]) ?>

    <?= Html::a('Visualizar comentários', ['comentario/index', 'id_evento' => $model->id_evento], ['class' => 'btn btn-primary']) ?>

</div>
