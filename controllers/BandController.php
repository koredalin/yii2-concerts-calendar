<?php

namespace app\controllers;

use Yii;
use app\models\Band;
use app\models\search\BandSearch;
use app\models\Concert;
use yii\web\Controller;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * BandController implements the CRUD actions for Band model.
 */
class BandController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
			'access' => [
				'class' => AccessControl::className(),
			    'ruleConfig' => [
			        'class' => AccessRule::className(),
			    ],
				'only' => ['create', 'update', 'delete', 'view', 'index', 'namelist'],
				'rules' => [
					[
						'actions' => ['create', 'update', 'delete', 'view', 'index', 'namelist'],
						'allow' => true,
						'roles' => ['@', 'admin'],
					],
				],
			],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Band models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BandSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Band model.
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
    
    public function actionNamelist($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = Band::find();
            $query->select('band_name AS id, band_name AS text')
                ->from('band')
                ->where(['like', 'band_name', $q])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Band::find($id)->band_name];
        }
        return $out;
    }

    /**
     * Creates a new Band model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Band();

//        $model->created_at = date('Y-m-d H:i:s');
//        $model->created_at = date('Y-m-d H:i:s');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Band model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $model->updated_at = date('Y-m-d H:i:s');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Band model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $concerts = $model->getConcerts();
        if (is_array($concerts) && count($concerts) > 0) {
            foreach ($concerts as $concertModel) {
                Concert::deleteBandPhoto($concertModel->photo_file_path);
            }
        }
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Band model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Band the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Band::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
