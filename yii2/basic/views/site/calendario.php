<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = 'Calendário';
?>

<h1>Menu</h1>
<h2>Professor</h2>


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
<?= Html::a('Ver Disciplinas', ['disciplina/index'], ['class' => 'btn btn-lg btn-success']) ?>
<br>
    </p>

</div>