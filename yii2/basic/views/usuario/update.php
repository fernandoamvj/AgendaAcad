<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = 'Atualizar Informações: ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Minha Conta', 'url' => ['view', 'codigo' => $model->codigo, 'email' => $model->email]];
//$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'codigo' => $model->codigo, 'email' => $model->email]];
$this->params['breadcrumbs'][] = 'Atualizar';

?>
<div class="usuario-update">

    <?php
    if(Yii::$app->user->id == $model->codigo){ ?>
        <h1><?= Html::encode($this->title) ?></h1>
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

        <?php
    }else{
        ?>
        <div class="alert alert-danger">
        <strong><?php echo "Sem permissão para editar."; ?></strong>
        </div>
        <?php
    }
    ?>

</div>