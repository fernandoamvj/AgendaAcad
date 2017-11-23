<?php
/**
 * Created by PhpStorm.
 * User: Marcos
 * Date: 22/11/2017
 * Time: 16:36
 */

namespace app\models;


use yii\base\Model;

class NewModel extends Model
{
    public $id_evento;

    public function rules() {
        return [
            ['id_evento', 'integer'],
        ];
    }
}