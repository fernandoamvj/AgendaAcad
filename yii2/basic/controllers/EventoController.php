<?php

namespace app\controllers;

use app\models\Disciplina;
use app\models\Usuario;
use Yii;
use app\models\Evento;
use app\models\EventoSearch;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\swiftmailer\Mailer;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EventoController implements the CRUD actions for Evento model.
 */
class EventoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Evento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EventoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $eventos_criados = Evento::find()
            ->select('evento.*')
            ->from('evento')
            ->where(['evento.id_usuario' => Yii::$app->user->identity->codigo]);
        $eventos_inscricao_disciplina = Evento::find()
            ->select('evento.*')
            ->from('inscricao')
            ->leftJoin('evento','inscricao.id_disciplina = evento.id_disciplina',[])
            ->where(['inscricao.id_usuario' => Yii::$app->user->identity->codigo]);
        $eventos_monitoria_disciplina = Evento::find()
            ->select('evento.*')
            ->from('disciplina')
            ->leftJoin('evento','disciplina.idDisciplina = evento.id_disciplina',[])
            ->where(['disciplina.id_monitor' => Yii::$app->user->identity->codigo]);

        //aqui sao os eventos a serem exibidos no calendario
        $events = $eventos_criados->union($eventos_inscricao_disciplina)->union($eventos_monitoria_disciplina)->all();

        foreach($events as $evento){
            $Event = new \yii2fullcalendar\models\Event();
            $Event->id = 1;
            $Event->title = $evento->nome;
            $Event->start = date($evento->data);
            $events[] = $Event;
        }

        if(!Yii::$app->user->isGuest) {
            //aqui sao os eventos a serem exibidos na lista logo abaixo, eles podem ser editados
            $eventos = $eventos_criados;
            //é monitor
            if (Disciplina::find()->where(['id_monitor' => Yii::$app->user->identity->codigo])->count() > 0)
                $eventos = $eventos->union($eventos_monitoria_disciplina);

            $dataProvider =  new ActiveDataProvider([
                'query' => $eventos,
            ]);

        }else{
            $dataProvider->query->filterWhere(['id_usuario' => 0]);
        }

        return $this->render('index', [
            'events' => $events,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Displays a single Evento model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Evento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Evento();

        if ($model->load(Yii::$app->request->post())) {
            $model->id_usuario=Yii::$app->user->identity->codigo;

            $emails_professor = Usuario::find()
                            ->select('email')
                            ->from('usuario')
                            ->where(array('in', 'codigo', (new Query())
                                ->select(['id_professor'])
                                ->from('disciplina')
                                ->where(['idDisciplina' => $model->id_disciplina])
                                ->all()));
             $emails_monitor = Usuario::find()
                            ->select('email')
                            ->from('usuario')
                            ->where(array('in', 'codigo', (new Query())
                                ->select(['id_monitor'])
                                ->from('disciplina')
                                ->where(['idDisciplina' => $model->id_disciplina])
                                ->all()));
             $emails_aluno = Usuario::find()
                            ->select('email')
                            ->from('usuario')
                            ->where(array('in', 'codigo', (new Query())
                                ->select(['id_usuario'])
                                ->from('disciplina')
                                ->leftJoin('inscricao','disciplina.idDisciplina = inscricao.id_disciplina',[])
                                ->where(['idDisciplina' => $model->id_disciplina])
                                ->all()));
            $emails = $emails_professor->union($emails_monitor)->union($emails_aluno)->all();

            foreach($emails as $email)
                Yii::$app->mailer->compose()
                    ->setFrom('agendaacad@domain.com')
                    ->setTo($email->email)
                    ->setSubject('Criação do evento: ' . $model->nome)
                    ->setTextBody("Informações: \nNome: ". $model->nome . "\nData: ". $model->data . "\nHora: " . $model->hora . "Tipo: " . $model->tipo . "Descricao: " . $model->descricao)
                    ->send();

            $model->save();
            return $this->redirect(['index', 'id' => $model->id_evento]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Evento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $emails_professor = Usuario::find()
                ->select('email')
                ->from('usuario')
                ->where(array('in', 'codigo', (new Query())
                    ->select(['id_professor'])
                    ->from('disciplina')
                    ->where(['idDisciplina' => $model->id_disciplina])
                    ->all()));
            $emails_monitor = Usuario::find()
                ->select('email')
                ->from('usuario')
                ->where(array('in', 'codigo', (new Query())
                    ->select(['id_monitor'])
                    ->from('disciplina')
                    ->where(['idDisciplina' => $model->id_disciplina])
                    ->all()));
            $emails_aluno = Usuario::find()
                ->select('email')
                ->from('usuario')
                ->where(array('in', 'codigo', (new Query())
                    ->select(['id_usuario'])
                    ->from('disciplina')
                    ->leftJoin('inscricao','disciplina.idDisciplina = inscricao.id_disciplina',[])
                    ->where(['idDisciplina' => $model->id_disciplina])
                    ->all()));
            $emails = $emails_professor->union($emails_monitor)->union($emails_aluno)->all();

            foreach($emails as $email)
                (new Mailer())->compose()
                ->setFrom('agendaacad@domain.com')
                ->setTo($email->email)
                ->setSubject('Alterações no evento: ' . $model->nome)
                ->setTextBody("Novas informações: \nNome: ". $model->nome . "\nData: ". $model->data . "\nHora: " . $model->hora . "Tipo: " . $model->tipo . "Descricao: " . $model->descricao)
                ->send();

            $model->save();
            return $this->redirect(['view', 'id' => $model->id_evento]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Evento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Evento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Evento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Evento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
