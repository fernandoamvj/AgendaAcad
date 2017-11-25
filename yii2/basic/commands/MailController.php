<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use Yii;
use yii\helpers\Url;
use yii\console\Controller;
use yii\db\ActiveRecord;
use app\models\Notificacao as Notificacao;
use app\models\Evento as Evento;
use app\models\Usuario as Usuario;

use yii\swiftmailer\Mailer;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Gabriela Ramalho <gabrielaramalho96@gmail.com>
 * @since 2.0
 */
class MailController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionSend($message = 'mensagem enviada')
    {
    	$notificacoes = Notificacao::find()->all();
    	date_default_timezone_set('America/Sao_Paulo');
		$dataAtual = new \DateTime('now', new \DateTimeZone('America/Sao_Paulo'));
		$dataAtual->format('Y-m-d H:i:s');
		echo "Data atual: ".$dataAtual->format('Y-m-d H:i:s')."\n";

  		foreach ($notificacoes as $notificacao){
  			echo "Usuario: $notificacao->id_usuario ";
			$email = Usuario::find()->select('email')
	        	                    ->from('usuario')
	            	                ->where(['codigo' => $notificacao->id_usuario])
	            	                ->one();
	                   # echo $email->email;
        	echo "Email: $email->email \n";

  			$eventos_criados = Evento::find()
            ->select('evento.*')
            ->from('evento')
            ->where(['evento.id_usuario' => $notificacao->id_usuario]);
	        $eventos_inscricao_disciplina = Evento::find()
	            ->select('evento.*')
	            ->from('inscricao')
	            ->innerJoin('evento', 'inscricao.id_disciplina = evento.id_disciplina', [])
	            ->where(['inscricao.id_usuario' => $notificacao->id_usuario]);
	        $eventos_professor_monitor_disciplina = Evento::find()
	            ->select('evento.*')
	            ->from('disciplina')
	            ->innerJoin('evento', 'disciplina.idDisciplina = evento.id_disciplina', [])
	            ->where(['disciplina.id_monitor' => $notificacao->id_usuario])
	            ->orWhere(['disciplina.id_professor' => $notificacao->id_usuario]);

	        //aqui sao os eventos do calendario do usuario
	        $eventos_visualizaveis = $eventos_criados->union($eventos_inscricao_disciplina)->union($eventos_professor_monitor_disciplina)->all();

	        foreach($eventos_visualizaveis as $evento){
	        	$dataEvento = new \DateTime($evento->data." " .$evento->hora);
	        	if($dataEvento >= $dataAtual){
		        	$dataEvento->format('Y-m-d H:i:s');
		        	echo "Data do Evento ".$dataEvento->format('Y-m-d H:i:s')."\n";
		        	$diff = $dataEvento->diff($dataAtual);
		        	echo $diff->format('%h:%i:%s'). "\n";
		        	$minutos = $diff->i + ($diff->h*60) + ($diff->days * 24 * 60);
		        	$min = '00:'.$minutos.':00';
		        	if($min == $notificacao->periodo_antecedencia){
		        	    Yii::$app->mailer->compose()
		                    ->setFrom('agendaacad17@gmail.com')
		                    ->setTo($email->email)
		                    ->setSubject('Notificação do evento: ' . $evento->nome)
		                    ->setTextBody("Informações: \nNome: " . $evento->nome . "\nData: " . $evento->data . "\nHora: " . $evento->hora . "\nTipo: " . $evento->tipo . "\nDescricao: " . $evento->descricao)
		                    ->send();

        				echo $message . "\n";
		        	}
		        }
	        }

  		}
    }
}
