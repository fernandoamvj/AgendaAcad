<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Evento;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Calendário';
$title2 = 'Eventos que você tem permissão pra editar';

$form = ActiveForm::begin();

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?php
    $eventos_criados2 = Evento::find()
            ->select(['evento.nome','evento.id_evento'])
            ->from('evento')
            ->where(['evento.id_usuario' => Yii::$app->user->identity->codigo]);
        $eventos_inscricao_disciplina2 = Evento::find()
            ->select(['evento.nome','evento.id_evento'])
            ->from('inscricao')
            ->innerJoin('evento','inscricao.id_disciplina = evento.id_disciplina',[])
            ->where(['inscricao.id_usuario' => Yii::$app->user->identity->codigo]);
        $eventos_professor_monitor_disciplina2 = Evento::find()
            ->select(['evento.nome','evento.id_evento'])
            ->from('disciplina')
            ->innerJoin('evento','disciplina.idDisciplina = evento.id_disciplina',[])
            ->where(['disciplina.id_monitor' => Yii::$app->user->identity->codigo])
            ->orWhere(['disciplina.id_professor' => Yii::$app->user->identity->codigo]);

        //aqui sao os eventos a serem exibidos no calendario
        $eventos_visualizaveis2 = $eventos_criados2->union($eventos_inscricao_disciplina2)->union($eventos_professor_monitor_disciplina2)->all();

    ?>
    <?= $form->field($model, 'id_evento')->label('Evento',[])->widget(Select2::classname(), [
            'data' => ArrayHelper::map($eventos_visualizaveis2,'id_evento','nome'),
            'language' => 'pt',
            'options' => ['placeholder' => 'Selecione Evento ... '],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= Html::a('Acessar Evento', ['view', 'id' => $model->id_evento], ['class' => 'btn btn-success']); ?>

    <?= Html::a('Criar Evento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_evento',

            'nome',
            'descricao',
            'data',
            'hora',

            [
                'label' => 'Disciplina',
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


    <br>
    <?= Html::a('Remover Eventos Cadastrados', ['excluireventos'], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Tem certeza de que quer excluir?',
            'method' => 'post',
        ],
    ]) ?>
    <br>

</div>
