<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Problems;
use app\models\Solutions;
use app\models\ProblemsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\helpers\Url;

/**
 * ProblemsController implements the CRUD actions for Problems model.
 */
class ProblemsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    
    public function actionMasalalar()
    {

        $query = Problems::find()->orderBy(['id' => SORT_DESC]);
        $pages = new Pagination(['totalCount' => $query->count(), 'defaultPageSize' => 10,]);
        $models = $query->offset($pages->offset)
        ->limit($pages->limit)
        ->all();

        return $this->render('masalalar', ['masalalar' => $models, 'sahifa' => $pages, 'soni' => $nums]);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['masalalar', 'problems', 'index'],
                'rules' => [
                    [
                        'actions' => ['masalalar', 'problems', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
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
     * Lists all Problems models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProblemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['user_id'=>Yii::$app->user->identity->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Problems model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Problems model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Problems();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Problems model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Problems model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Problems model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Problems the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Problems::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionSolutions($problem_id)
    {
        //id bo'yicha Masalani chiqarish
        $n = Problems::findOne($problem_id);
        //problem_id bo'yicha Izohlarni chiqarish


        $yechimlar = Solutions::find()->where(['problem_id'=>$problem_id])->orderBy(['id'=>SORT_ASC])->all();
        
        $model = new Solutions();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->adddate=date("Y-m-d H:i:s");
                $model->save();
                $url = Url::to(['problems/solutions', 'problem_id' => $problem_id]);
                return $this->redirect($url);
            }
        }

        return $this->render('solutions', [
            'model' => $model,
            'problem' => $n,
            'solutions' => $yechimlar,
        ]);
    }
    public function actionDeletesolution($solution_id, $problem_id, $uid)
    {
        if($uid == Yii::$app->user->identity->id)
        {
           $n = Solutions::findOne($solution_id);
           $n->delete();
        }
        $url = Url::to(['problems/solutions', 'problem_id' => $problem_id]);
        return $this->redirect($url);
    }
}
