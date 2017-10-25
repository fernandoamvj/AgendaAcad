<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = 'Calendario2';
?>

<h1>Menu</h1>
<h2>Aluno</h2>

<div class="jumbotron">
    <p>
    <h2>Eventos </h2>
    <br>
    <?= Html::a('Criar Evento', ['evento/index'], ['class' => 'btn btn-lg btn-success']) ?>
    <br>
    <br>
    </p>

    <p>
    <h2>Disciplina </h2>
    <br>
    <?= Html::a('Inscrever Disciplina', ['disciplina/inscrever'], ['class' => 'btn btn-lg btn-success']) ?>
    <br>
    </p>

</div>