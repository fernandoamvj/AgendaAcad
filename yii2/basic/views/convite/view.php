<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Convite */

$this->title = $model->id_convite;
$this->params['breadcrumbs'][] = ['label' => 'Convites', 'url' => ['index', 'id_evento' => $model->id_evento]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="convite-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar informações', ['update', 'id' => $model->id_convite], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id_convite], [
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
            ['label' => 'Evento',
                'attribute'=>'idEvento.nome',
            ],
            ['label' => 'Usuario',
                'attribute'=>'idUsuario.nome',
            ],
        ],
    ]) ?>

</div>
