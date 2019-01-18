<?php
namespace admin\controllers;
use Yii;
use admin\models\User;
use admin\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for user model.
 */
class UserController extends Controller
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
     * Lists all user models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	

    /**
     * Displays a single user model.
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
     * Creates a new user model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
		//$model -> skill_level = 'B';
		//$model -> other_courses = 'N';
		$model -> status = 'Y';
		//$model -> created_at = date('Y-m-d H:i:s');
		$intVal = date('Y-m-d');
		//$model -> created_at = date('Ymd');
		//$model -> updated_at = date('Ymd');
		$user = new User();
		//$password = 
		$model->generateAuthKey();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			$uploadedFile=UploadedFile::getInstance($model,'user_pic');
		   if(isset($uploadedFile -> tempName) && in_array($uploadedFile->extension, array('jpg','png','gif')))
		   {
				$uploadedFile->saveAs(Yii::getAlias('@webroot/images/user/').$uploadedFile -> name);
				$model->user_pic = $uploadedFile -> name;	
		   }
		  $model->password_hash = Yii::$app->security->generatePasswordHash($model->password_hash);
		      $url = "http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($model -> address1)."&sensor=false";
		 $result_string = file_get_contents($url);
		  $resultarr = json_decode($result_string, true);
		  $lat = "";
		  $long = "";
		  $finalresult = array();
		  if(isset($resultarr['results'][0]['geometry']['location']['lat']))
			 {
			  $lat = $resultarr['results'][0]['geometry']['location']['lat']; // get first if more than 1 
			 }
			 if(isset($resultarr['results'][0]['geometry']['location']['lng']))
			 {
			  $long = $resultarr['results'][0]['geometry']['location']['lng'];
			 }
			 if(($lat!='')&&($long!=''))
			 {
			$finalresult['lat'] = $lat;
			$finalresult['long'] = $long;
			 }
			 else
			 {
			if(isset($resultarr['result']['geometry']['location']['lat']))
			{
		   $lat = $resultarr['result']['geometry']['location']['lat'];
			}
			if(isset($resultarr['result']['geometry']['location']['lng']))
			{
		   $long = $resultarr['result']['geometry']['location']['lng'];
			}
			$finalresult['lat'] = $lat;
			$finalresult['long'] = $long;
			 }
			$model -> loc_lat = $lat;
			$model -> loc_long = $long;
			//print_r($model->project_id); 
			$list1=implode(",", $model->project_id);
			//print_r($list1); exit;
			$model->project_id=$list1;
		     
				
		   $model->save();
		    //mkdir($model->first_name. "sales");
			Yii::$app->session->setFlash('success','Information Saved Successfully');
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing user model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) 
		{
			/*$uploadedFile=UploadedFile::getInstance($model,'user_pic');
		   if(isset($uploadedFile -> tempName) && in_array($uploadedFile->extension, array('jpg','png','gif')))
		   {
				$uploadedFile->saveAs(Yii::getAlias('@webroot/images/user/').'/'.$uploadedFile -> name);
				$model->user_pic = $uploadedFile;	
				//print_r($model->user_pic); exit;
		   }	*/

		   $image = UploadedFile::getInstance($model,'user_pic');
			if(isset($image))
			{
				if(isset($image -> tempName) && in_array($image->extension, array('jpg','png','gif')))
				{
					$image->saveAs(Yii::getAlias('@webroot/images/user/').'/'.$image->name);	
					$model->user_pic = $image;
					//print_r($model->user_pic); exit;
				}
			}
 	   
	//print_r($model->project_id); exit;
	    $list1=implode(",", $model->project_id);
	 
	//print_r($list1); exit;
	 $model->project_id=$list1;
		$model->save(); 
		 
		 if(Yii::$app->user->identity->usertype=="administrator"){
			Yii::$app->session->setFlash('success','Information Updated Successfully');
            return $this->redirect(['index', 'id' => $model->id]);
		 } else {
			 Yii::$app->session->setFlash('success','Information Updated Successfully');
            return $this->redirect(['update', 'id' => $model->id]);
		 }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing user model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
 		//$sql="DELETE FROM login_history where userid='".$id."' ";
		//$model = Yii::$app->db->createCommand($sql)->queryAll();
		$x = Yii::$app->db->createCommand("DELETE FROM login_history WHERE userid = '$id'")->execute();
		
		Yii::$app->session->setFlash('success', 'Information Deleted Successfully');
        return $this->redirect(['index']);
    }

    /**
     * Finds the user model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return user the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = user::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
