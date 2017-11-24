<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Convite */

$this->title = 'Enviar Convite';
$this->params['breadcrumbs'][] = ['label' => 'Convites', 'url' => ['index', 'id_evento' => $id_evento]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="convite-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
