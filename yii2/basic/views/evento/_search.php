<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Evento;

/* @var $this yii\web\View */
/* @var $model app\models\EventoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]);
    ?>

    <?= $form->field($model, 'id_evento')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Evento::find()
            ->select(['nome','data','id_evento'])
            ->from('evento')
            ->asArray()
            ->all(),'id_evento', 'nome', 'data'),
        'language' => 'pt',
        'options' => ['placeholder' => 'Digite o evento  ... '],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?php ActiveForm::end(); ?>

    <?php $model->load(Yii::$app->request->post()); ?>

    <div class="form-group">
        <?= Html::a('Visualizar Evento', ['view', 'id' => $model->id_evento], ['class' => 'btn btn-primary']) ?>
    </div>

</div>
