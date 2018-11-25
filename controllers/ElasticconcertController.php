<?php

namespace app\controllers;

use Yii;
use app\models\ElasticConcert;
use app\models\search\ElasticConcertSearch;
use app\models\Concert;

use yii\web\Controller;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * ConcertController implements the CRUD actions for Concert model.
 */
class ElasticconcertController extends Controller
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
				'only' => ['save', 'index', 'search', 'createindex', 'updatemapping', 'deleteindex',],
				'rules' => [
                    [
						'actions' => ['save', 'index', 'search',],
						'allow' => true,
						'roles' => ['@', 'admin'],
                    ],
                    [
						'actions' => ['createindex', 'updatemapping', 'deleteindex',],
						'allow' => true,
						'roles' => ['admin'],
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
    
    public function actionSave($id)
    {
        $elastic        = new ElasticConcert();
        $concertModel = $this->findModel($id);
        $elastic->id  = $concertModel->id;
        $elastic->concert_date  = $concertModel->date;
        $elastic->band_name  = $concertModel->band->band_name;
        $elastic->concert_location  = $concertModel->location;
        $elastic->country_name  = $concertModel->country->country_name;
        if ($elastic->insert()) {
            return "Added Successfully";
        } else {
            return "Error";
        }
    }

    /**
     * Lists all Concert models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
 
    public function actionSearch()
    {
        $elastic = new ElasticConcertSearch();
//        print_r(Yii::$app->request->queryParams); exit;
        $result  = $elastic->Searches(Yii::$app->request->queryParams);
        $query = Yii::$app->request->queryParams;
//        print_r($result); exit;
        return $this->render('search', [
            'searchModel'  => $elastic,
            'dataProvider' => $result,
            'query'        => $query['search'],
        ]);
    }
 
    public function actionCreateindex()
    {
        ElasticConcert::createIndex();
        
        return 'ElasticConcert index created. Mapping set.';
    }
 
    public function actionUpdatemapping()
    {
        ElasticConcert::updateMapping();
        
        return 'ElasticConcert mapping updated.';
    }
 
    public function actionDeleteindex()
    {
        ElasticConcert::deleteIndex();
        
        return 'ElasticConcert index deleted.';
    }

    /**
     * Finds the Concert model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Concert the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Concert::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
