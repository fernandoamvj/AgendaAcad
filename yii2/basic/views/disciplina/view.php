<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Disciplina */

$this->title = $model->nome_disciplina;
$this->params['breadcrumbs'][] = ['label' => 'Disciplinas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disciplina-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar informações', ['update', 'id' => $model->idDisciplina], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->idDisciplina], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem certeza de que quer excluir?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idDisciplina',
            'nome_disciplina',
            'id_professor',
            'id_monitor',
            'datainicio',
            'datafim',
        ],
    ]) ?>

</div>
