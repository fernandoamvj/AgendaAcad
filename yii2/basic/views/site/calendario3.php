<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = 'Calendário';

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
    <?= Html::a('Ver Calendário', ['evento/index'], ['class' => 'btn btn-lg btn-success']) ?>
    <br>
    <br>
    </p>

    <p>
    <h2>Disciplina </h2>
    <br>
    <?= Html::a('Inscrever Disciplina', ['inscricao/index'], ['class' => 'btn btn-lg btn-success']) ?>
    <br>
    </p>

    <p>
    <h2>Notificação </h2>
    <br>
    <?= Html::a('Notificação de Eventos Futuros', ['notificacao/index'], ['class' => 'btn btn-lg btn-success']) ?>
    <br>
    </p>

    <p>
    <h2>Conta de Usuário </h2>
    <br>
    <?= Html::a('Minha Conta', ['usuario/index'], ['class' => 'btn btn-lg btn-success']) ?>
    <br>
    </p>

</div>