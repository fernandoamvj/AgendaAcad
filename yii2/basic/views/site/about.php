<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Sobre';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Esta é a página Sobre. Você pode alterar o seguinte arquivo para mudar seu conteúdo:
    </p>

    <code><?= __FILE__ ?></code>
</div>
