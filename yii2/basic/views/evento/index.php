<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Evento;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Calendário';
$title2 = 'Eventos que você tem permissão pra editar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-11">
            <?= Html::a('Criar Evento', ['create'], ['class' => 'btn btn-success']) ?>
            </a>
        </div>
        <div class="col-lg-1">
            <a>
            <?= Html::a('Notificações', ['notificacao/create'], ['class' => 'btn btn-success']) ?>
            </a>
        </div>
    </div>

     <?= \yii2fullcalendar\yii2fullcalendar::widget(array(
      'events'=> $events,
      'options' => [
        'lang' => 'pt-br',
      ],
    ));
     ?>

    <script type='text/javascript'>
        $('#calendar').fullCalendar({
            eventClick: function (event){
                if (event . url) {
                    window . open(event . url);
                    return false;
                }
            }
        });
    </script>

    <h1><?= Html::encode($title2) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_evento',

            'nome',
            'descricao',
            'data',
            'hora',

            [
                'label' => 'Discplina',
                'attribute'=>'id_disciplina',
                'value'=>'idDisciplina.nome_disciplina'
            ],
            [
                'label' => 'Criador',
                'attribute'=>'idUsuario.nome',
            ],
            
            //'tipo',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
