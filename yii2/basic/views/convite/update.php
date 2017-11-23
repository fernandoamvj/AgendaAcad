<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Convite */

$this->title = 'Atualizar Convite: ' . $model->id_convite;
$this->params['breadcrumbs'][] = ['label' => 'Convites', 'url' => ['index', 'id_evento' => $model->id_evento]];
$this->params['breadcrumbs'][] = ['label' => $model->id_convite, 'url' => ['view', 'id' => $model->id_convite]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="convite-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
