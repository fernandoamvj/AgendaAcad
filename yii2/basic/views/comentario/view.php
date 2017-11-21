<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Comentario */

$this->title = 'Comentário: ' . $model->id_comentario;
$this->params['breadcrumbs'][] = ['label' => 'Comentários', 'url' => ['index', 'id_evento' => $model->id_evento]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comentario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
        if( $model->id_usuario == Yii::$app->user->identity->codigo){
            $exibir_botoes = true;
        } else {
            $exibir_botoes = false;
        }
    ?>
    <p>
        <?php if($exibir_botoes) echo Html::a('Atualizar informações', ['update', 'id' => $model->id_comentario], ['class' => 'btn btn-primary']) ?>
        <?php if($exibir_botoes) echo Html::a('Excluir', ['delete', 'id' => $model->id_comentario], [
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
