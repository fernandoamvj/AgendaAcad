<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Usuario;
use dosamigos\datepicker\DatePicker;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\Disciplina */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="disciplina-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome_disciplina')->textInput(['maxlength' => true]) ?>

     <!-- <?= $form->field($model, 'id_monitor')->dropDownList(
        ArrayHelper::map(Usuario::find()->where(['tipo' => 1])->all(),'codigo','nome'),['prompt'=>'Selecione Aluno']
    ) ?>  -->

   <?= $form->field($model, 'id_monitor')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Usuario::find()->where(['tipo' => 1])->all(),'codigo','nome'),
        'language' => 'pt',
        'options' => ['placeholder' => 'Selecione Aluno ... '],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'datafim')->widget(
        DatePicker::className(), [
            // inline too, not bad
             'inline' => false, 
             // modify template for custom rendering
            //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
            'clientOptions' => [
                'autoclose' => false,
                'format' => 'yyyy-mm-dd'
            ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
