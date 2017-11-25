<?php

namespace app\controllers;

use app\models\Disciplina;
use MongoDB\Driver\Query;
use Yii;
use app\models\Inscricao;
use app\models\InscricaoSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InscricaoController implements the CRUD actions for Inscricao model.
 */
class InscricaoController extends Controller
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
     * Lists all Inscricao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InscricaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        if (!Yii::$app->user->isGuest) {
            if(Yii::$app->user->identity->tipo==2) {        //é professor
                $inscricoes = Inscricao::find()
                            ->select('inscricao.*')
                            ->from('inscricao ')
                            ->innerJoin('disciplina','inscricao.id_disciplina = disciplina.idDisciplina',[])
                            ->where(['disciplina.id_professor' => Yii::$app->user->getId()]);
                $dataProvider = new ActiveDataProvider([
                    'query' => $inscricoes,
                ]);
            } else {                                         //n é
                $dataProvider->query->filterWhere(['id_usuario' => Yii::$app->user->getId()]);
            }
        }else{
            $dataProvider->query->filterWhere(['id_usuario' => 0]);
        }

        if(Yii::$app->user->identity->tipo==2){
            return $this->render('index2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * Displays a single Inscricao model.
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
     * Creates a new Inscricao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Inscricao();

        if ($model->load(Yii::$app->request->post()) ) {
            //se n é professor
            if(Yii::$app->user->identity->tipo!=2)
<<<<<<< HEAD
                $model->id_usuario = Yii::$app->user->identity->codigo;
=======
                $model->id_usuario = Yii::$app->user->getId();

>>>>>>> d90ad5e83079c9e3cc9c59c0b86fbeb384374d3d
            $model->save();
            return $this->redirect(['index', 'id' => $model->codigo]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Inscricao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->codigo]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Inscricao model.
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
     * Finds the Inscricao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Inscricao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Inscricao::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Esta página não existe.');
        }
    }


}
