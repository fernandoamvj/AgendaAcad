<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Comentario */

$this->title = 'Criar Comentario';
$this->params['breadcrumbs'][] = ['label' => 'Comentários', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comentario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
