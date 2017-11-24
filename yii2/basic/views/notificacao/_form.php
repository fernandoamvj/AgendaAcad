<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Notificacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notificacao-form">

    <?php $form = ActiveForm::begin(); ?>
    <p>Avise-me a respeito de um evento antes do mesmo começar</p>

    <?= $form->field($model, 'periodo_antecedencia')->dropDownList(['15 min' => '15 min antes', '30 min' => '30 min antes', '1 semana' => '1 semana antes',], ['prompt' => '---Selecione o período---']); ?>

    <div class="form-group">
        <?= Html::submitButton('Ativar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
