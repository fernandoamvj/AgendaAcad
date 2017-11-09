<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Minha Conta', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar informações', ['update', 'codigo' => $model->codigo, 'email' => $model->email], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'codigo' => $model->codigo, 'email' => $model->email], [
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
            'codigo',
            'nome',
            'email:email',
            'tipo',
            'senha',
        ],
    ]) ?>

</div>
