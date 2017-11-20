<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Comentario */

$this->title = 'Atualizar Comentário: ' . $model->id_comentario;
$this->params['breadcrumbs'][] = ['label' => 'Comentarios', 'url' => ['index', 'id_evento' => $model->id_evento]];
$this->params['breadcrumbs'][] = ['label' => $model->id_comentario, 'url' => ['view', 'id' => $model->id_comentario]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="comentario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
