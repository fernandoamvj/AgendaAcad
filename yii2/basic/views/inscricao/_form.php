<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Disciplina;
use app\models\Usuario;

/* @var $this yii\web\View */
/* @var $model app\models\Inscricao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inscricao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_disciplina')->dropDownList(
        ArrayHelper::map(Disciplina::find()->all(),'idDisciplina', 'nome'),['prompt'=>'Selecione Disciplina']
    ) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
