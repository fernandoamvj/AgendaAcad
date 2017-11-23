<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Usuario;

/* @var $this yii\web\View */
/* @var $model app\models\Convite */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="convite-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'id_evento')->textInput() ?>

    <?= $form->field($model, 'id_usuario')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Usuario::find()->all(),'codigo','nome'),
        'language' => 'pt',
        'options' => ['placeholder' => 'Selecione Usuário ... '],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
