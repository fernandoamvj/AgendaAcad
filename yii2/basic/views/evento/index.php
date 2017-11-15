<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Calendário';
$title2 = 'Eventos que você tem permissão pra editar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Criar Evento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
     <?= \yii2fullcalendar\yii2fullcalendar::widget(array(
      'events'=> $events,
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

            'id_evento',
            'nome',
            'descricao',
            'data',
            'hora',
            'id_disciplina',
            'id_usuario',
            //'tipo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
