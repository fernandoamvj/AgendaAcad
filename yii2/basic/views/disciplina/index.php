<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Usuario;
use yii\db\ActiveQuery;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DisciplinaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Disciplinas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disciplina-index">

    <h1><?= Html::encode($this->title) ?></h1>
      
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Criar Disciplina', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nome_disciplina',

            ['label' => ' Nome Monitor',
             'attribute' => 'id_monitor',
             'value'=>'idMonitor.nome',
             ],
            
            'datainicio',
            'datafim',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
