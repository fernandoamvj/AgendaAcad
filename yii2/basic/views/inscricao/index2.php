<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Disciplina;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InscricaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

if(Yii::$app->user->identity->tipo==2) { //professor
    $titulo_create = 'Adicionar aluno em disciplina';
    $this->title = 'Gerenciar Inscrições';
}else {                                    //n é
    $titulo_create = 'Inscrever em disciplina';
    $this->title = 'Inscrição';
}
$this->params['breadcrumbs'][] = $this->title;


?>

<div class="inscricao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a($titulo_create, ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'id_disciplina',
                'value'=>'idDisciplina.nome_disciplina'
            ],
            ['label' => ' Aluno',
             'attribute' => 'idUsuario.nome',
             ],                    

            ['class' => 'yii\grid\ActionColumn', 'template' => '{delete}']
        ],
    ]); ?>
</div>
