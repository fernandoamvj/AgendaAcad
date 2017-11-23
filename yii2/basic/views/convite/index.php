<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ConviteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Convites';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="convite-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Criar Convite', ['create', 'id_evento' => $id_evento], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['label' => 'Evento',
                'attribute'=>'id_evento',
                'value'=>'idEvento.nome',
            ],
            ['label' => 'Usuario',
                'attribute'=>'id_usuario',
                'value' => 'idUsuario.nome',
            ],

            ['class' => 'yii\grid\ActionColumn','template'=>'{view}' ],
        ],
    ]); ?>
</div>
