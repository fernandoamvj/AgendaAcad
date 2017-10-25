<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 09/10/2017
 * Time: 20:23
 */

namespace app\controllers;

use Yii;
use app\models\CadastroModel;
use yii\base\Controller;

class ExerciciosController extends Controller
{

    public function actionFormulario()
    {
        $cadastroModel = new CadastroModel;
        $post = Yii::$app->request->post();

        if ($cadastroModel->load($post) && $cadastroModel->validate()) {
            return $this->render('formulario-confirmacao', [
                'model' => $cadastroModel
            ]);
        }

        return $this->render('formulario', [
            'model' => $cadastroModel
        ]);
    }

}