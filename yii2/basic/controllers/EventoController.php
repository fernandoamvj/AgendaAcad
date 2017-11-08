<?php

namespace app\controllers;

use Yii;
use app\models\Evento;
use app\models\EventoSearch;
use yii\data\ActiveDataProvider;
use yii\db\Query;
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

        $events1 = Evento::find()
            ->select('evento.*')
            ->from('evento')
            ->where(['evento.id_usuario' => Yii::$app->user->identity->codigo]);
        $events2 = Evento::find()
            ->select('evento.*')
            ->from('inscricao')
            ->leftJoin('evento','inscricao.id_disciplina = evento.id_disciplina',[])
            ->where(['inscricao.id_usuario' => Yii::$app->user->identity->codigo]);

        $events = $events1->union($events2)->all();

        foreach($events as $evento){
            $Event = new \yii2fullcalendar\models\Event();
            $Event->id = 1;
            $Event->title = $evento->nome;
            $Event->start = date($evento->data);
            $events[] = $Event;
        }

        if(!Yii::$app->user->isGuest) {
            $dataProvider->query->filterWhere(['id_usuario' => Yii::$app->user->identity->codigo]);
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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
