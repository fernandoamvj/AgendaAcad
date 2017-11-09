<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Disciplina;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Inscricao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inscricao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_disciplina')->dropDownList(
        ArrayHelper::map(Disciplina::findBySql('SELECT disciplina.idDisciplina, disciplina.nome_disciplina, usuario.nome 
                                                    FROM disciplina 
                                                    LEFT JOIN usuario ON disciplina.id_professor = usuario.codigo',[])
                                    ->asArray()
                                    ->all(),'idDisciplina', 'nome', 'nome_disciplina'),['prompt'=>'Selecione Disciplina']
    ) ?>

    


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
