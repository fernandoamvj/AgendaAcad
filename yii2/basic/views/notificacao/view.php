<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Notificacao */

$this->title = 'Notificação';
$this->params['breadcrumbs'][] = ['label' => 'Notificações', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notificacao-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar informações', ['update', 'id' => $model->id_usuario], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id_usuario], [
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
            'periodo_antecedencia',
        ],
    ]) ?>

</div>
