<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Disciplina */

$this->title = 'Atualizar Disciplina: ' . $model->nome_disciplina;
$this->params['breadcrumbs'][] = ['label' => 'Disciplinas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idDisciplina, 'url' => ['view', 'id' => $model->idDisciplina]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="disciplina-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
