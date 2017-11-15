<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Notificacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notificacao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'data_hora_notificacao')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
