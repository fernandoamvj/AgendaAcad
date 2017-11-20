<?php

/* @var $this yii\web\View */
use yii\helpers\Html;


$this->title = 'AgendaAcad';
?>
<div class=" col-md-12 site-index">

    <div class="jumbotron col-md-12">


         <img class="col-xs-offset-2 col-md-9" src="\AgendaAcad\yii2\basic\Images\logoAgendaAcad.png" alt="logo" ">
        <!--  Html::img('@app/Images/logoAgendaAcad.png', ['alt' => 'logo'])
        <!-- <h1>Agenda Acad</h1> -->

        <div class=" col-md-12">
            <p class="lead">Aqui voce poderá ver todos os seus compromissos e agendamentos do CEFET!</p>

                <?php
                    if(!Yii::$app->user->isGuest)
                        echo Html::a('Meu Calendário', ['evento/index'], ['class' => 'btn btn-lg btn-success']);
                    else
                        echo Html::a('Login', ['login'], ['class' => 'btn btn-lg btn-success']);
                ?>
                <?= Html::a('Cadastrar', ['usuario\create'], ['class' => 'btn btn-lg btn-success']) ?>
            </p>
        </div>

    </div>

    <div class="body-content">

        <!-- conteudo aqui  -->

    </div>
</div>


