<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InscricaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

if(Yii::$app->user->identity->tipo==2) { //professor
    $titulo_create = 'Adicionar aluno em disciplina';
    $this->title = 'Gerenciar Inscrições';
}else {                                    //n é
    $titulo_create = 'Criar Inscrição';
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

            'codigo',
            'id_disciplina',
            'id_usuario',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
