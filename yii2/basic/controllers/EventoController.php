<?php

namespace app\controllers;

use app\models\Comentario;
use app\models\Disciplina;
use app\models\NewModel;
use app\models\Usuario;
use Yii;
use app\models\Evento;
use app\models\EventoSearch;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
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
        $NewModel = new NewModel();
        if($NewModel->load(Yii::$app->request->post())){

            return $this->redirect(['view', 'id' => $NewModel->id_evento]);
        } else {
            $searchModel = new EventoSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $eventos_criados = Evento::find()
                ->select('evento.*')
                ->from('evento')
                ->where(['evento.id_usuario' => Yii::$app->user->getId()]);
            $eventos_inscricao_disciplina = Evento::find()
                ->select('evento.*')
                ->from('inscricao')
                ->innerJoin('evento', 'inscricao.id_disciplina = evento.id_disciplina', [])
                ->where(['inscricao.id_usuario' => Yii::$app->user->getId()]);
            $eventos_professor_monitor_disciplina = Evento::find()
                ->select('evento.*')
                ->from('disciplina')
                ->innerJoin('evento', 'disciplina.idDisciplina = evento.id_disciplina', [])
                ->where(['disciplina.id_monitor' => Yii::$app->user->getId()])
                ->orWhere(['disciplina.id_professor' => Yii::$app->user->getId()]);

            //aqui sao os eventos a serem exibidos no calendario
            $eventos_visualizaveis = $eventos_criados->union($eventos_inscricao_disciplina)->union($eventos_professor_monitor_disciplina)->all();

            foreach ($eventos_visualizaveis as $evento) {
                $Event = new \yii2fullcalendar\models\Event();
                $Event->id = 1;
                $Event->title = $evento->nome;
                $Event->start = date($evento->data);
                $Event->url = 'http://localhost/AgendaAcad/yii2/basic/web/index.php?r=evento%2Fview&id=' . $evento->id_evento;
                if ($evento->id_usuario == Yii::$app->user->getId())
                    $Event->color = 'yellow';
                else
                    $Event->color = 'blue';
                $Event->description = $evento->descricao;
                $eventos_visualizaveis[] = $Event;
            }


            if (!Yii::$app->user->isGuest) {
                $eventos_criados2 = Evento::find()
                    ->select('evento.*')
                    ->from('evento')
                    ->where(['evento.id_usuario' => Yii::$app->user->getId()]);
                $eventos_professor_monitor_disciplina2 = Evento::find()
                    ->select('evento.*')
                    ->from('disciplina')
                    ->innerJoin('evento', 'disciplina.idDisciplina = evento.id_disciplina', [])
                    ->where(['disciplina.id_monitor' => Yii::$app->user->getId()])
                    ->orWhere(['disciplina.id_professor' => Yii::$app->user->getId()]);

                //aqui sao os eventos a serem exibidos na lista logo abaixo, eles podem ser editados
                $eventos_editaveis = $eventos_criados2;

                if ($eventos_professor_monitor_disciplina2->count() > 0)
                    $eventos_editaveis->union($eventos_professor_monitor_disciplina2);


                $dataProvider = new ActiveDataProvider([
                    'query' => $eventos_editaveis,
                ]);

            } else {
                $dataProvider->query->filterWhere(['id_usuario' => 0]);
            }

            return $this->render('index', [
                'NewModel' => $NewModel,
                'events' => $eventos_visualizaveis,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
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
            $model->id_usuario=Yii::$app->user->getId();

            $emails_professor = Usuario::find()
                            ->select('email')
                            ->from('usuario u')
                            ->innerJoin('disciplina d','u.codigo = d.id_professor',[])
                            ->where(['d.idDisciplina' => $model->idDisciplina]);
            $emails_monitor = Usuario::find()
                            ->select('email')
                            ->from('usuario u')
                            ->innerJoin('disciplina d','u.codigo = d.id_monitor',[])
                            ->where(['d.idDisciplina' => $model->idDisciplina]);
            $emails_aluno = Usuario::find()
                            ->select('email')
                            ->from('usuario u')
                            ->innerJoin('inscricao i','u.codigo = i.id_usuario',[])
                            ->where(['i.id_disciplina' => $model->idDisciplina]);

            if($model->idDisciplina != null) {
                $emails = $emails_professor->union($emails_monitor)->union($emails_aluno)->all();

                foreach ($emails as $email)
                    Yii::$app->mailer->compose()
                        ->setFrom('agendaacad17@gmail.com')
                        ->setTo($email->email)
                        ->setSubject('Criação do evento: ' . $model->nome)
                        ->setTextBody("Informações: \nNome: " . $model->nome . "\nData: " . $model->data . "\nHora: " . $model->hora . "\nTipo: " . $model->tipo . "\nDescricao: " . $model->descricao)
                        ->send();
            }

            $model->save();
            return $this->redirect(['index']);
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

            $emails_professor1 = Usuario::find()
                ->select('email')
                ->from('usuario u')
                ->innerJoin('disciplina d','u.codigo = d.id_professor',[])
                ->where(['d.idDisciplina' => $model->idDisciplina]);
            $emails_monitor1 = Usuario::find()
                ->select('email')
                ->from('usuario u')
                ->innerJoin('disciplina d','u.codigo = d.id_monitor',[])
                ->where(['d.idDisciplina' => $model->idDisciplina]);
            $emails_aluno1 = Usuario::find()
                ->select('email')
                ->from('usuario u')
                ->innerJoin('inscricao i','u.codigo = i.id_usuario',[])
                ->where(['i.id_disciplina' => $model->idDisciplina]);

            if($model->idDisciplina != null) {
                $emails1 = $emails_professor1->union($emails_monitor1)->union($emails_aluno1)->all();

                foreach ($emails1 as $email1)
                    Yii::$app->mailer->compose()
                        ->setFrom('agendaacad17@gmail.com')
                        ->setTo($email1->email)
                        ->setSubject('Alterações no evento: ' . $model->nome)
                        ->setTextBody("Novas informações: \nNome: " . $model->nome . "\nData: " . $model->data . "\nHora: " . $model->hora . "\nTipo: " . $model->tipo . "\nDescricao: " . $model->descricao)
                        ->send();
            }

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
            throw new NotFoundHttpException('Esta página não existe.');
        }
    }

    public function actionExcluireventos()
    {
        $ids_evento = Evento::find()
                ->select('id_evento')
                ->where(['id_usuario' => Yii::$app->user->getId()])
                ->asArray()
                ->all();

        foreach($ids_evento as $id_evento) {
            $ids_comentario = Comentario::find()
                            ->select('id_comentario')
                            ->where(['id_evento' => $id_evento])
                            ->asArray()
                            ->all();
            foreach($ids_comentario as $id_comentario)
                ComentarioController::findModel($id_comentario)->delete();

            $this->findModel($id_evento)->delete();

        }
        return $this->redirect(['index']);
    }
}
