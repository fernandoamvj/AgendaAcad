<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NotificaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notificacaos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notificacao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Criar Notificacao', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_notificacao',
            'id_evento',
            'data_hora_notificacao',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
