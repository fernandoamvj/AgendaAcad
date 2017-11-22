<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NotificaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notificações';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notificacao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Criar Notificações', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_notificacao',
            
            'data_hora_notificacao',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
