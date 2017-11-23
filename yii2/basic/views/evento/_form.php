<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Disciplina;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Evento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'data')->widget(
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

    <?= $form->field($model, 'hora')->textInput(['type'=> 'time']) ?>

    <?= $form->field($model, 'descricao')->label('Descrição',[])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_disciplina')->label('Disciplina',[])
        ->dropDownList(ArrayHelper::map(Disciplina::find()
                            ->where(['id_professor' => Yii::$app->user->identity->codigo])
                            ->orWhere(['id_monitor' => Yii::$app->user->identity->codigo])
                            ->all(),'idDisciplina','nome_disciplina'),['prompt'=>'Selecione Disciplina']
    ) ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
