<?php

/* @var $this yii\web\View */
use yii\helpers\Html;


$this->title = 'AgendaAcad';
?>
<div class="site-index">

    <div class="jumbotron">


         <img src="\Projetos\AgendaAcad\yii2\basic\Images\logoAgendaAcad.png" alt="logo" style="width:561.375px;height:400px;">
        <!--  Html::img('@app/Images/logoAgendaAcad.png', ['alt' => 'logo'])
        <!-- <h1>Agenda Acad</h1> -->

        <p class="lead">Aqui voce poderá ver todos os seus compromissos e agendamentos do CEFET!</p>

            <?= Html::a('Meu Calendário', ['login'], ['class' => 'btn btn-lg btn-success']) ?>
            <?= Html::a('Cadastrar', ['usuario/create'], ['class' => 'btn btn-lg btn-success']) ?>
        </p>

    </div>

    <div class="body-content">

        <!-- conteudo aqui  -->

    </div>
</div>


