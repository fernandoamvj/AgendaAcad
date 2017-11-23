<?php

namespace app\controllers;

use app\models\Evento;
use app\models\Usuario;
use Yii;
use app\models\Convite;
use app\models\ConviteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ConviteController implements the CRUD actions for Convite model.
 */
class ConviteController extends Controller
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
     * Lists all Convite models.
     * @return mixed
     */
    public function actionIndex($id_evento)
    {
        $searchModel = new ConviteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->query->filterWhere(['id_evento' => $id_evento]);


        return $this->render('index', [
            'id_evento' => $id_evento,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Convite model.
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
     * Creates a new Convite model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_evento)
    {
        $model = new Convite();

        if ($model->load(Yii::$app->request->post())) {
            $model->id_evento = $id_evento;
            $model->save();

            $evento = Evento::findOne($model->id_evento);
            $usuario = Usuario::findOne($model->id_usuario);
            Yii::$app->mailer->compose()
                ->setFrom('agendaacad17@gmail.com')
                ->setTo($usuario->email)
                ->setSubject('Convite para evento: ' . $evento->nome)
                ->setTextBody("Informações: \nNome: " . $evento->nome . "\nData: " . $evento->data . "\nHora: " . $evento->hora . "\nTipo: " . $evento->tipo . "\nDescricao: " . $evento->descricao)
                ->send();

            return $this->redirect(['index', 'id_evento' => $model->id_evento]);
        } else {
            return $this->render('create', [
                'id_evento' => $id_evento,
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Convite model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id_evento' => $model->id_evento]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Convite model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->findModel($id)->delete();

        return $this->redirect(['index', 'id_evento' => $model->id_evento]);
    }

    /**
     * Finds the Convite model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Convite the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Convite::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Esta página não existe.');
        }
    }
}
