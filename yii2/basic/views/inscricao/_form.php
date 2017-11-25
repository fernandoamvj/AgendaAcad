<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Disciplina;
use kartik\select2\Select2;
use app\models\Usuario;

/* @var $this yii\web\View */
/* @var $model app\models\Inscricao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inscricao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
            if(Yii::$app->user->identity->tipo==2)
                    echo $form->field($model, 'id_usuario')->label('Aluno',[])->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Usuario::find()->where(['tipo' => 1])->all(),'codigo','nome'),
                    'language' => 'pt',
                    'options' => ['placeholder' => 'Selecione Aluno ... '],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
    ?>

    <?php
    if(Yii::$app->user->identity->tipo==2){
        echo $form->field($model, 'id_disciplina')->label('Disciplina',[])->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Disciplina::findBySql('SELECT disciplina.idDisciplina, disciplina.nome_disciplina, usuario.nome 
                                                        FROM disciplina 
                                                        LEFT JOIN usuario ON disciplina.id_professor = usuario.codigo '.
                                                        ' WHERE disciplina.id_professor='.Yii::$app->user->id,[])
                                                        ->asArray()
                                                        ->all(),'idDisciplina', 'nome_disciplina', 'nome'),
            'language' => 'pt',
            'options' => ['placeholder' => 'Digite a materia  ... '],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    } else {
        echo $form->field($model, 'id_disciplina')->label('Disciplina',[])->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Disciplina::findBySql('SELECT disciplina.idDisciplina, disciplina.nome_disciplina, usuario.nome 
                                                        FROM disciplina 
                                                        LEFT JOIN usuario ON disciplina.id_professor = usuario.codigo',[])
                ->asArray()
                ->all(),'idDisciplina', 'nome_disciplina', 'nome'),
            'language' => 'pt',
            'options' => ['placeholder' => 'Digite a materia  ... '],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    }
     echo $form->field($model, 'id_semestre')->textInput() 
    ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Inscrever' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>