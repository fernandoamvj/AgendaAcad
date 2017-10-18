<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 09/10/2017
 * Time: 19:58
 */

namespace app\controllers;


use yii\web\Controller;

class HelloController extends Controller
{
    public function actionSaySomething($msg ='hello'){
        return $this-> render('say-something',[
            'msg' =>$msg
        ]);
    }
}