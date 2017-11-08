<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InscricaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inscrição';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="inscricao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Criar Inscrição', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'codigo',
            'id_disciplina',
            'id_usuario',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
