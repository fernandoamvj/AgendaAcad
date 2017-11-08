<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = 'Calendario';

/*
<p>
    <h2>Monitoria </h2>
    <br>
    <?= Html::a('Disciplinas em que sou Monitor', ['disciplina/index'], ['class' => 'btn btn-lg btn-success']) ?>
    <br>
</p>
*/
?>

<h1>Menu</h1>
<h2>Monitor</h2>

<div class="jumbotron">
    <p>
    <h2>Eventos </h2>
    <br>
    <?= Html::a('Ver Eventos', ['evento/index'], ['class' => 'btn btn-lg btn-success']) ?>
    <br>
    <br>
    </p>

    <p>
    <h2>Disciplina </h2>
    <br>
    <?= Html::a('Inscrever Disciplina', ['inscricao/index'], ['class' => 'btn btn-lg btn-success']) ?>
    <br>
    </p>

</div>