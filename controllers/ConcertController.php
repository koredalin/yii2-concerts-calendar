<?php

namespace app\controllers;

use Yii;
use app\models\Concert;
use app\models\search\ConcertSearch;
use app\models\Band;
use app\models\BandPhoto;
use app\models\query\CountryQuery;
use yii\web\UploadedFile;
//use yii\helpers\Url;
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
				'only' => ['sendnewestconcerts', 'create', 'update', 'delete', 'view', 'index'],
				'rules' => [
                    [
						'actions' => ['sendnewestconcerts'],
						'allow' => true,
						'roles' => ['?', '@', 'admin'],
                    ],
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
        $post = Yii::$app->request->isPost ? Yii::$app->request->post() : array();
        $this->formatPostDate($post);
        $isPostBand = isset($post['Band']['band_name']) && !empty($post['Band']['band_name']);
        if ($isPostBand) {
            $bandModel = Band::findOne(['band_name' => trim($post['Band']['band_name'])]);
        }
        !isset($bandModel) ? $bandModel = new Band() : false;
        $bandPhotoModel = new BandPhoto();
        $countries = CountryQuery::getAllCountriesDropdown();
        $isValidBand = $bandModel->load($post) && $bandModel->save();
        if ($isValidBand) {
            $model->band_id = (int)$bandModel->id;
            $isBandPhoto = array_key_exists('BandPhoto', $post);
            $model->has_photo = 0;
            $isValidConcert = $model->load($post) && $model->save();
            $bandPhotoModel->imageFile = UploadedFile::getInstance($bandPhotoModel, 'imageFile');
            if ($isBandPhoto && $isValidConcert && $bandPhotoModel->uploadBandPhoto($model->id)) {
                    $model->has_photo = 1;
                    $model->photo_file_path = $bandPhotoModel->imageFileName;
                    $isValidConcert = $model->save();
            }
            if ($isValidConcert) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'bandModel' => $bandModel,
            'bandPhotoModel' => $bandPhotoModel,
            'countries' => $countries,
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
        $bandModel = $model->band;
        $bandPhotoModel = new BandPhoto();
        $countries = CountryQuery::getAllCountriesDropdown();
        $post = Yii::$app->request->isPost ? Yii::$app->request->post() : array();
        $this->formatPostDate($post);
        $bandModel->updated_at = date('Y-m-d H:i:s');
        $isValidBand = $bandModel->load($post) && $bandModel->save();
        if (Yii::$app->request->isPost && $isValidBand) {
            $model->band_id = (int)$bandModel->id;
            $bandPhotoModel->imageFile = UploadedFile::getInstance($bandPhotoModel, 'imageFile');
            if($bandPhotoModel->uploadBandPhoto($model->id)) {
                $model->has_photo = 1;
                $model->photo_file_path = $bandPhotoModel->imageFileName;
            }
            $model->updated_at = date('Y-m-d H:i:s');
            $isValidConcert = $model->load($post) && $model->save();
            if ($isValidConcert) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'bandModel' => $bandModel,
            'bandPhotoModel' => $bandPhotoModel,
            'countries' => $countries,
        ]);
    }
    
    private function formatPostDate(&$post)
    {
        if (isset($post['Concert']['date']) && !empty($post['Concert']['date'])) {
            $post['Concert']['date'] = date('Y-m-d', strtotime($post['Concert']['date']));
        }
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
        $model = $this->findModel($id);
        Concert::deleteBandPhoto($model->photo_file_path);
        $model->delete();

        return $this->redirect(['index']);
    }
    
    public function actionSendnewestconcerts()
    {
        $newestConcerts = Concert::find()->getNewestConcerts();
        if (!is_array($newestConcerts) || empty($newestConcerts)) {
            return 'No new concerts.';
        }
        $recipientMails = array(Yii::$app->params['adminEmail']);
        $mailer = Yii::$app->mailer->compose()
                    ->setFrom(Yii::$app->params['defaultEmailSender'])
                    ->setSubject('Band Concerts Calendar. Newest concerts');
            $htmlContent = $this->renderPartial('mail_layouts/newest_concerts', ['newestConcerts' => $newestConcerts]);
            $mailer->setTo($recipientMails)
                    ->setHtmlBody($htmlContent)
                    ->send();
        return 'Success';
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
