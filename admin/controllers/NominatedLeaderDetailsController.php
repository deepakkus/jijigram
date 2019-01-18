<?php
namespace admin\controllers;
use Yii;
use admin\models\NominatedLeaderDetails;
use admin\models\NominateLeader;
use admin\models\PostSearch;
use frontend\models\FollowerDetails;
use admin\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
/**
 * PostController implements the CRUD actions for Post model.
 */
class NominatedLeaderDetailsController extends Controller
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
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
		if (Yii::$app->user->isGuest)		
		{		
			return $this->redirect(['site/login']);		
		}
        /*$searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);*/
		$model = new NominatedLeaderDetails();
        /*return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/
		return $this->render('index', [
            'model' => $model
        ]);
    }
    /**
     * Displays a single Post model.
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
     * Deletes an existing Post model.
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
		Yii::$app->session->setFlash('success', "Post Deleted Successfully");
        return $this->redirect(['index']);
    }
    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

	/**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUserList($id)
    {
		$model = new NominateLeader;
		$sql = '
		SELECT u.*
		FROM nominated_leader_details as ld
		INNER JOIN  nominated_leader as nl ON nl.id = ld.nominated_leader_id
		INNER JOIN  user as u ON u.id = ld.FID where nl.id = "'.$id.'"
		';
		
		$query  =  User::findBySql($sql);
		$dataProvider = new ActiveDataProvider([
			//'query' => NominatedLeaderDetails::find(),
			'query' => $query,
			'pagination' => [
				'pageSize' => 20,
			],
		]);
 		return $this->render('userList', [
                'model' => $model,
				'dataProvider' => $dataProvider,
            ]);
			
    }
	/**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionNominateLeader($id)
    {
		/*$model = new NominateLeader;
		$query = NominatedLeaderDetails ::find()->where(['id' => $id])->one();
		$sql = '
		SELECT *
		FROM nominated_leader_details as ld
		INNER JOIN  nominated_leader as nl ON nl.id = ld.nominated_leader_id where ld.id = "'.$id.'"
		';
		$result = Yii::$app->db->createCommand($sql)->queryOne(); 
		$first_name = $result['leader_name'];
		$totalFollow = Yii::$app->db->createCommand( 'SELECT ld.FID
		FROM nominated_leader_details as ld
		INNER JOIN  nominated_leader as nl ON nl.id = ld.nominated_leader_id 
		where ld.id = "'.$id.'"')->queryAll();
		
		$user = new User;
		$user ->first_name = $first_name;
		$user ->username = 'abc@gmail.com';
		$user ->email = 'abc@gmail.com';
		$user ->usertype = 'L';
		$user ->gender = 'M';
		$user ->password_hash = '1234567';
		$user ->save();
		$leaderId = $user['id'];
		foreach($totalFollow as $res)
		{
			$followerId = $res['FID'];		
			$follower = new FollowerDetails;
			$follower ->FID = $followerId;
			$follower ->LID = $leaderId;
			$follower ->save();
		}
		if($user ->save() && $user ->validate())
		{
			Yii::$app->session->setFlash('success', "User Nominated as Leader Successfully");
		}
		else
		{
			Yii::$app->session->setFlash('error', "Sorry, You have a error");
		}*/
		$sql = '
		SELECT *
		FROM nominated_leader_details as ld
		INNER JOIN  nominated_leader as nl ON nl.id = ld.nominated_leader_id where ld.id = "'.$id.'"
		';
		$result = Yii::$app->db->createCommand($sql)->queryOne(); 
		$first_name = $result['leader_name'];
		$user = new User;
		if ($user->load(Yii::$app->request->post())) {
			$data = Yii::$app->request->post();
		$user ->first_name = $first_name;
		$user ->username = $data['User']['email'];
		$email = $user ->email = $data['User']['email'];
		$user ->usertype = 'L';
		$user ->gender = 'M';
		$user -> auth_key = Yii::$app->security->generateRandomString();
		$password = Yii::$app->security->generateRandomString(6);
		$user ->password_hash = Yii::$app->security->generatePasswordHash($password);
		
		$mail =  Yii::$app->mailer->compose()		  
					 ->setFrom('admin@jijigram.com')
					 //->setTo($emailInfo['LeaderInvite']['email'])
					 ->setTo($data['User']['email'])
					 ->setSubject('Nominated Leader Information')
					 ->setHtmlBody('
					 <b>Hi Dear, You Nominated as Leader. Now You can Login as Leader</b><br>
					 <a href="https://www.jijigram.com/site/login">Please Click Here To Login</a> <br>
					  Your credentials - <br>
					 <b>Your Password </b>- '.$password.' <br>
					 <br>')
					->send();
				   if($mail)
				   {		
						Yii::$app->session->setFlash('success','Mail Sent Successfully.');
				   }
				   else
				   {
						Yii::$app->session->setFlash('error','Sorry!could not sent mail');
				   }
		//echo '<pre>';print_r($user);
		$user ->save();
		//echo '<pre>';print_r($user['id']);
		$leaderId = $user['id'];
		$totalFollow = Yii::$app->db->createCommand( 'SELECT ld.FID
		FROM nominated_leader_details as ld
		INNER JOIN  nominated_leader as nl ON nl.id = ld.nominated_leader_id 
		where ld.id = "'.$id.'"')->queryAll();
		foreach($totalFollow as $res)
		{
			$followerId = $res['FID'];		
			$follower = new FollowerDetails;
			$follower ->FID = $followerId;
			$follower ->LID = $leaderId;
			$follower ->save();
		}
		if($user ->save() && $user ->validate())
		{
			Yii::$app->session->setFlash('success', "User Nominated as Leader Successfully");
		}
		else
		{
			Yii::$app->session->setFlash('error', "Sorry, You have a error");
		}
		Yii::$app->session->setFlash('success', "User Nominated as Leader Successfully");	
            return $this->redirect(['index', 'id' => $user->id]);
		}
		return $this->render('nominateLeader', [
                'user' => $user
            ]);
    }
}