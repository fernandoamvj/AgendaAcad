<?php

namespace app\controllers;

use Yii;
use app\models\Disciplina;
use app\models\Usuario;
use app\models\DisciplinaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\ActiveRecord;
use yii\base\Component;


/**
 * DisciplinaController implements the CRUD actions for Disciplina model.
 */
class DisciplinaController extends Controller
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
     * Lists all Disciplina models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DisciplinaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$name = 'jhon';
     
        if(!Yii::$app->user->isGuest) {
            if (Disciplina::find()->where(['id_monitor' => Yii::$app->user->getId()])->count() > 0)
                $dataProvider->query->filterWhere(['id_monitor' => 0]); /*Yii::$app->user->getId()*/
            else if(Yii::$app->user->identity->tipo == 2)
                $dataProvider->query->filterWhere(['id_professor' => Yii::$app->user->getId()]);
            else
                $dataProvider->query->filterWhere(['id_monitor' => 0]);
        } else {
            $dataProvider->query->filterWhere(['id_monitor' => 0]);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            //'name'=>$name
        ]);
    }

    /**
     * Displays a single Disciplina model.
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
     * Creates a new Disciplina model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Disciplina();
         
        if ($model->load(Yii::$app->request->post())) {
            $model->id_professor = Yii::$app->user->getId();
            $model->datainicio = date('y-m-d h:m:s');
            $model->save();

            return $this->redirect(['index', 'id' => $model->idDisciplina]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Disciplina model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idDisciplina]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Disciplina model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        $this->trigger();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Disciplina model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Disciplina the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Disciplina::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Esta página não existe.');
        }
    }

   
    
}




