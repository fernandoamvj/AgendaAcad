<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NotificacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notificações';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notificacao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php 
        # Verifica se já cadastrou alguma notificação para que o botão de criar só apareça se não cadastrou notificação
        if($dataProvider->totalCount == 0){
            echo '<p>
                <a href="index.php?r=notificacao/create" class = "btn btn-success">Criar Notificações</a>
            </p>';
    
        }

    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'periodo_antecedencia',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
