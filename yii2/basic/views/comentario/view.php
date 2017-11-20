<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Comentario */

$this->title = $model->id_comentario;
$this->params['breadcrumbs'][] = ['label' => 'Comentários', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comentario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar informações', ['update', 'id' => $model->id_comentario], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id_comentario], [
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
            'id_comentario',
            'id_evento',
            'id_usuario',
            'comentario',
            'data_comentario',
        ],
    ]) ?>

</div>
