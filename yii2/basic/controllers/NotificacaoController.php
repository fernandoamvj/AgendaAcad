<?php

namespace app\controllers;

use Yii;
use app\models\Notificacao;
use app\models\NotificacaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NotificacaoController implements the CRUD actions for Notificacao model.
 */
class NotificacaoController extends Controller
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
     * Lists all Notificacao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NotificacaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if($dataProvider->totalCount <= 0){
            return $this->actionCreate();
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Notificacao model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionAtivar(){
        $id = Yii::$app->user->getId();
        if (($model = Notificacao::findOne(['id_usuario' => $id])) !== null)
            return $this->redirect(['update', 'id' => $model->id_notificacao]);
        else
            return $this->redirect(['create']);
    }
    /**
     * Creates a new Notificacao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Notificacao();

        if ($model->load(Yii::$app->request->post())) {
            $model->id_usuario = Yii::$app->user->getId();
            $model->save();
            return $this->redirect(['evento/index']);
        //    return $this->redirect(['view', 'id' => $model->id_usuario]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Notificacao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['evento/index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Notificacao model.
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
     * Finds the Notificacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Notificacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Notificacao::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Esta página não existe.');
        }
    }
}
