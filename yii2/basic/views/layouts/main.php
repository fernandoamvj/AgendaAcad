<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Disciplina;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Home',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            Yii::$app->user->isGuest ? (
                ['label' => 'Menu', 'url' => ['/site/login']]
            ) : (
                Yii::$app->user->identity->tipo==2 ? (
                    ['label' => 'Menu', 'url' => ['site/calendario']]
                ):(
                    Disciplina::find()->where(['id_monitor' => Yii::$app->user->identity->codigo])->count() > 0 ? (
                        ['label' => 'Menu', 'url' => ['site/calendario3']]
                    ):(
                        ['label' => 'Menu', 'url' => ['site/calendario2']]
                    )
                )
            ),
            ['label' => 'Sobre', 'url' => ['/site/about']],
            ['label' => 'Contato', 'url' => ['/site/contact']],/*
            Yii::$app->user->isGuest ? (
                ['label' => 'Cadastrar', 'url' => ['usuario/create']]
            ) : (
                ['label' => 'Minha Conta', 'url' => ['/usuario/index']]
            ),*/
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                //. Html::a('Menu', ['site/calendario'], ['class' => 'navbar-nav '])
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->nome . ')',
                    ['class' => 'btn btn-link logout'])
                . Html::endForm()

                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Agenda Acad <?= date('Y') ?></p>

       <!-- <p class="pull-right"><?= Yii::powered() ?></p>-->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
