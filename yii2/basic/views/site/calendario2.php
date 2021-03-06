<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = 'Calendário';
?>

<h1>Menu</h1>
<h2>Aluno</h2>

<div class="jumbotron">
    <p>
    <h2>Eventos </h2>
    <br>
    <?= Html::a('Meu Calendário', ['evento/index'], ['class' => 'btn btn-lg btn-success']) ?>
    <br>
    <br>
    </p>

    <p>
    <h2>Disciplina </h2>
    <br>
    <?= Html::a('Inscrever em Disciplina', ['inscricao/index'], ['class' => 'btn btn-lg btn-success']) ?>
    <br>
    </p>

    <p>
    <h2>Conta de Usuário </h2>
    <br>
    <?= Html::a('Minha Conta', ['usuario/view'], ['class' => 'btn btn-lg btn-success']) ?>
    <br>
    </p>

</div>