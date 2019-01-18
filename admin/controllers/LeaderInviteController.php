<?php
namespace admin\controllers;
use Yii;
use admin\models\LeaderInvite;
use admin\models\LeaderInviteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
/**
 * LeaderInviteController implements the CRUD actions for LeaderInvite model.
 */
class LeaderInviteController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all LeaderInvite models.
     * @return mixed
     */
    public function actionIndex()
    {
		if (Yii::$app->user->isGuest)		
		{		
			return $this->redirect(['site/login']);		
		}
        $searchModel = new LeaderInviteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single LeaderInvite model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
		if (Yii::$app->user->isGuest)		
		{		
			return $this->redirect(['site/login']);		
		}
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * Creates a new LeaderInvite model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		if (Yii::$app->user->isGuest)		
		{		
			return $this->redirect(['site/login']);		
		}
        $model = new LeaderInvite();
		$model->generateCodeKey();
        if ($model->load(Yii::$app->request->post())) {
			$emailInfo = Yii::$app->request->post();
			$toemail = $emailInfo['LeaderInvite']['email'];
			$name = $emailInfo['LeaderInvite']['name'];
			if(trim($name) == NULL && trim($toemail) == NULL)
			{
				Yii::$app->session->setFlash('error','Sorry! At least 1 of the field Name & Email must be filled up properly'); 
			}
			
			if($toemail != '')
			{
			   $mail =  Yii::$app->mailer->compose()		  
				 ->setFrom('admin@jijigram.com')
				 ->setTo($toemail)
				 ->setSubject('Invitation Link')
				 ->setHtmlBody('
				 <b>Hi Dear, Please click the link below to sign up as leader.</b><br><br>
				 <a href="https://www.jijigram.com/site/signup/?'.$model->code.'">Click Here</a>')
				 ->send();
			   if($mail)
			   {		
					Yii::$app->session->setFlash('success','Mail Sent Successfully');
			   }
			   else
			   {
					Yii::$app->session->setFlash('error','Sorry!could not sent mail');
			   }
			}
			if($toemail != '' || $name != '')
			{
				$model->save();
            	return $this->redirect(['index', 'id' => $model->id]);
			}
			
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    /**
     * Updates an existing LeaderInvite model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
		if (Yii::$app->user->isGuest)		
		{		
			return $this->redirect(['site/login']);		
		}
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			Yii::$app->session->setFlash('success','Information updated Successfully');
            return $this->redirect(['index', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }
    /**
     * Deletes an existing LeaderInvite model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
		if (Yii::$app->user->isGuest)		
		{		
			return $this->redirect(['site/login']);		
		}
        $this->findModel($id)->delete();
		Yii::$app->session->setFlash('success','Information Deleted Successfully');
        return $this->redirect(['index']);
    }
    /**
     * Finds the LeaderInvite model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LeaderInvite the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LeaderInvite::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
	public function actionViewcode($id)
    {
		$model = $this->findModel($id);
		$sql = LeaderInvite::find()
        ->where(['id' => $id])
        ->one();
		$code = $sql['code'];
		//$code = $_REQUEST['code'];
		 return $this->render('viewcode', [
            'code' => $code,
			'model' => $model,
        ]);
	}
}