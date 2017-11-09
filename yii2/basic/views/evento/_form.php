<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Disciplina;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Evento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'data')->textInput(['type'=>'date']) ?>

    <?= $form->field($model, 'hora')->textInput(['type'=> 'time']) ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_disciplina')->dropDownList(ArrayHelper::map(Disciplina::find()->where(['id_professor' => Yii::$app->user->identity->codigo])->orWhere(['id_monitor' => Yii::$app->user->identity->codigo])->all(),'idDisciplina','nome_disciplina'),['prompt'=>'Selecione Disciplina']
    ) ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
