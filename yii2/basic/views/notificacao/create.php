<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Notificacao */

$this->title = 'Criar Notificação';
$this->params['breadcrumbs'][] = ['label' => 'Notificações', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notificacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
