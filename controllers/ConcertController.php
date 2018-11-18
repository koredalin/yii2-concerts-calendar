<?php

namespace app\controllers;

use Yii;
use app\models\Concert;
use app\models\search\ConcertSearch;
use app\models\Band;
use app\models\BandPhoto;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * ConcertController implements the CRUD actions for Concert model.
 */
class ConcertController extends Controller
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
				'only' => ['create', 'update', 'delete', 'view', 'index'],
				'rules' => [
					[
						'actions' => ['create', 'update', 'delete', 'view', 'index'],
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
     * Lists all Concert models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ConcertSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Concert model.
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
     * Displays a single Concert model.
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUploadbandphoto()
    {
        $bandPhotoModel = new BandPhoto();
        
        if (Yii::$app->request->isPost) {
            $bandPhotoModel->imageFile = UploadedFile::getInstance($bandPhotoModel, 'imageFile');
            if ($bandPhotoModel->upload()) {
                // file is uploaded successfully
                return;
            }
        }
        
        return $this->render('upload_photo', [
            'bandPhotoModel' => $bandPhotoModel,
        ]);
    }

    /**
     * Creates a new Concert model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Concert();
        $bandModel = new Band();
        $bandPhotoModel = new BandPhoto();
        $post = Yii::$app->request->isPost ? Yii::$app->request->post() : array();
        
        
        /*
        $isValidConcert = $model->load($post) && $model->save();
        $isValidBand = $bandModel->load($post) && $bandModel->save();
        $isBandPhoto = array_key_exists('UploadBandPhoto', $post);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        if ($bandModel->load(Yii::$app->request->post()) && $bandModel->save()) {
            return $this->redirect(['view', 'id' => $bandModel->id]);
        }
        if ($isBandPhoto) {
            $bandPhotoModel->imageFile = UploadedFile::getInstance($bandPhotoModel, 'imageFile');
            $isUploadedPhoto = (int)$bandPhotoModel->upload();
            if ($isUploadedPhoto) {
                echo __LINE__ . ' |||| ';
                return;
            }
        }
        /**/

        return $this->render('create', [
            'model' => $model,
            'bandModel' => $bandModel,
            'bandPhotoModel' => $bandPhotoModel,
        ]);
    }

    /**
     * Updates an existing Concert model.
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
     * Deletes an existing Concert model.
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
