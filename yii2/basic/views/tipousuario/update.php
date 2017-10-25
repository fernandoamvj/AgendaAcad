<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tipousuario */

$this->title = 'Update Tipousuario: ' . $model->id_tipo_usuario;
$this->params['breadcrumbs'][] = ['label' => 'Tipousuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tipo_usuario, 'url' => ['view', 'id' => $model->id_tipo_usuario]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipousuario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
