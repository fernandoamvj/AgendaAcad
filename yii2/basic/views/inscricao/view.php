<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Inscricao */

$this->title = $model->codigo;
$this->params['breadcrumbs'][] = ['label' => 'Inscrições', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inscricao-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar informações', ['update', 'id' => $model->codigo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->codigo], [
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
            'id_disciplina',
            'id_usuario',
        ],
    ]) ?>

</div>
