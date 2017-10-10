<?php
use \yii\bootstrap\ActiveForm;
use \yii\helpers\Html;
?>


<h2>Fomrulario Cadastro </h2>
<hr>


<?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'nome')?>
    <?= $form->field($model, 'email')?>
    <?= $form->field($model, 'idade')?>
<div class="form-group">
    <?= Html::submitButton('EnviarDados', ['class'=>'btn btn-primary'])?>
</div>

<?php ActiveForm::end() ?>
