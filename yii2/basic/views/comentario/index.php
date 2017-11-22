<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ComentarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comentários';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comentario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Criar Comentário', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_comentario',
            ['label' => 'Evento',
             'attribute'=>'id_evento',
             'value'=>'idEvento.nome',
            ],
            ['label' => 'Usuario',
             'attribute'=>'id_usuario',
             'value' => 'idUsuario.nome',
            ],
            
            'comentario',
            'data_comentario',

            ['class' => 'yii\grid\ActionColumn','template'=>'{view}' ],
        ],
    ]); ?>
</div>
