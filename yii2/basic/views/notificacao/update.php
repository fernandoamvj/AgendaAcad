<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Notificacao */

$this->title = 'Ativar Notificação ';
$this->params['breadcrumbs'][] = 'Ativar Notificação';
?>
<div class="notificacao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
