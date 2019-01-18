<?php
namespace admin\controllers;
use Yii;
use admin\models\Companies;
use admin\models\Categories; 
use admin\models\Comments;
use admin\models\CompaniesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * PagesController implements the CRUD actions for Companies model.
 */
class CompaniesController extends Controller
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
     * Lists all Companies models.
     * @return mixed
     */
    public function actionIndex()
    {
		if (Yii::$app->user->isGuest)
		{
		return $this->redirect(['site/login']);
        }
        $searchModel = new CompaniesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single Companies model.
     * @param integer $co_id
     * @return mixed
     */
    public function actionView($id)
    {
       return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * Creates a new Companies model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		if (Yii::$app->user->isGuest)
		{
		return $this->redirect(['site/login']);
        }
        $model = new Companies();
		//$model->name=addslashes($_POST['name']);
		
		
		$model -> status = 'active';
		$sqlcat="select * from categories";
		$category= Yii::$app->db->createCommand($sqlcat)->queryAll();
        if ($model->load(Yii::$app->request->post()))
		{
			$contracts=UploadedFile::getInstance($model,'contracts');
			$cat_id = array();
			$data = Yii::$app->request->post();
			$cat_id= $data['Companies']['cat_id'];
			
			if(isset($cat_id) && !empty($cat_id))
			{
			$model ->cat_id = implode(",",$cat_id); 
			}
	
			if(isset($contracts -> tempName) && in_array($contracts->extension, array('jpg','pdf','png','gif')))
			{
   				$contracts->saveAs(Yii::getAlias('@webroot/images/contracts/').'/'.$contracts->name);	
			    $model->contracts=$contracts;
			}
			//print_r($model); die;
			$model->save();
			// Saving to refrence database starts
			$id = Yii::$app->db->getLastInsertID();
			$model = $this->findModel($id);
 			$site_id = $model->site_id;
			$ref_id = $model->ref_id;
			$name = addslashes($model->name);
			$contact = $model->contact;
			$address1 = addslashes($model->address1);
			$address2 = addslashes($model->address2);
			$city = addslashes($model->city);
			$state = addslashes($model->state);
			$zipcode = $model->zipcode;
			$country = $model->country;
			$phone = $model->phone;
			$fax = $model->fax;
			$email = $model->email;
			$website = addslashes($model->website);
			$status	= $model->status;
			if(($site_id>0)&&($site_id<7))
			{
				$insertSQL="INSERT INTO companies (name, contact, address1, address2,city,state,zipcode,country,phone,fax,email,website,status)

				VALUES ('".$name."','".$contact."','".$address1."','".$address2."','".$city."','".$state."','".$zipcode."','".$country."','".$phone."','".$fax."','".$email."','".$website."','".$status."')"; 

				

					if($site_id == '1')
					{
						Yii::$app->dbasd->createCommand($insertSQL)->execute();
						$ref_id = Yii::$app->dbasd->getLastInsertID();
						
						$status="active";
						$li_type="standard";
						$insertmasterSQL="INSERT INTO master_listings (co_id, mod_date, exp_date, status,li_type)
						VALUES ('".$ref_id."',NOW(),NOW(),'".$status."','".$li_type."')";
						Yii::$app->dbasd->createCommand($insertmasterSQL)->execute();
						$refmaster_id = Yii::$app->dbasd->getLastInsertID();

						foreach($cat_id as $catlist)
						{
							$categoryId = Categories::findOne($catlist);
 							$categoryId1=$categoryId['ref_id'];
							$insertlistingSQL="INSERT INTO listings (ma_li_id, cat_id)
							VALUES ('".$refmaster_id."','".$categoryId1."')";
							Yii::$app->dbasd->createCommand($insertlistingSQL)->execute();
							 							
						}
					}
					elseif($site_id == '2')
					{
						Yii::$app->dbmboa->createCommand($insertSQL)->execute();
						$ref_id = Yii::$app->dbmboa->getLastInsertID();
						
						$status="active";
						$li_type="standard";
						$insertmasterSQL="INSERT INTO master_listings (co_id, mod_date, exp_date, status,li_type)
						VALUES ('".$ref_id."',NOW(),NOW(),'".$status."','".$li_type."')";
						Yii::$app->dbmboa->createCommand($insertmasterSQL)->execute();
						$refmaster_id = Yii::$app->dbmboa->getLastInsertID();

						foreach($cat_id as $catlist)
						{
							$categoryId = Categories::findOne($catlist);
 							$categoryId1=$categoryId['ref_id'];
							$insertlistingSQL="INSERT INTO listings (ma_li_id, cat_id)
							VALUES ('".$refmaster_id."','".$categoryId1."')";
							Yii::$app->dbmboa->createCommand($insertlistingSQL)->execute();				 
						}
					}
					elseif($site_id == '3')
					{
						Yii::$app->dbmbtoa->createCommand($insertSQL)->execute();
						$ref_id = Yii::$app->dbmbtoa->getLastInsertID();
						
						$status="active";
						$li_type="standard";
						$insertmasterSQL="INSERT INTO master_listings (co_id, mod_date, exp_date, status,li_type)
						VALUES ('".$ref_id."',NOW(),NOW(),'".$status."','".$li_type."')";
						Yii::$app->dbmbtoa->createCommand($insertmasterSQL)->execute();
						$refmaster_id = Yii::$app->dbmbtoa->getLastInsertID();

						foreach($cat_id as $catlist)
						{
							$categoryId = Categories::findOne($catlist);
 							$categoryId1=$categoryId['ref_id'];
							$insertlistingSQL="INSERT INTO listings (ma_li_id, cat_id)
							VALUES ('".$refmaster_id."','".$categoryId1."')";
							Yii::$app->dbmbtoa->createCommand($insertlistingSQL)->execute();				 
						}
					}
					elseif($site_id == '4')
					{
						Yii::$app->dbmcoa->createCommand($insertSQL)->execute();
						$ref_id = Yii::$app->dbmcoa->getLastInsertID();
						
						$status="active";
						$li_type="standard";
						$insertmasterSQL="INSERT INTO master_listings (co_id, mod_date, exp_date, status,li_type)
						VALUES ('".$ref_id."',NOW(),NOW(),'".$status."','".$li_type."')";
 						Yii::$app->dbmcoa->createCommand($insertmasterSQL)->execute();
						$refmaster_id = Yii::$app->dbmcoa->getLastInsertID();

						foreach($cat_id as $catlist)
						{
							$categoryId = Categories::findOne($catlist);
 							$categoryId1=$categoryId['ref_id'];
							$insertlistingSQL="INSERT INTO listings (ma_li_id, cat_id)
							VALUES ('".$refmaster_id."','".$categoryId1."')";
							Yii::$app->dbmcoa->createCommand($insertlistingSQL)->execute();				 
						}
					}
					elseif($site_id == '5')
					{
						Yii::$app->dbmoroa->createCommand($insertSQL)->execute();
						$ref_id = Yii::$app->dbmoroa->getLastInsertID();
						
						$status="active";
						$li_type="standard";
						$insertmasterSQL="INSERT INTO master_listings (co_id, mod_date, exp_date, status,li_type)
						VALUES ('".$ref_id."',NOW(),NOW(),'".$status."','".$li_type."')";
						Yii::$app->dbmoroa->createCommand($insertmasterSQL)->execute();
						$refmaster_id = Yii::$app->dbmoroa->getLastInsertID();

						foreach($cat_id as $catlist)
						{
							$categoryId = Categories::findOne($catlist);
 							$categoryId1=$categoryId['ref_id'];
							$insertlistingSQL="INSERT INTO listings (ma_li_id, cat_id)
							VALUES ('".$refmaster_id."','".$categoryId1."')";
							Yii::$app->dbmoroa->createCommand($insertlistingSQL)->execute();				 
						}
					}
					elseif($site_id == '6')
					{
						Yii::$app->dbmtoa->createCommand($insertSQL)->execute();
						$ref_id = Yii::$app->dbmtoa->getLastInsertID();
						
						$status="active";
						$li_type="standard";
						$insertmasterSQL="INSERT INTO master_listings (co_id, mod_date, exp_date, status,li_type)
						VALUES ('".$ref_id."',NOW(),NOW(),'".$status."','".$li_type."')";
						Yii::$app->dbmtoa->createCommand($insertmasterSQL)->execute();
						$refmaster_id = Yii::$app->dbmtoa->getLastInsertID();

						foreach($cat_id as $catlist)
						{
							$categoryId = Categories::findOne($catlist);
 							$categoryId1=$categoryId['ref_id'];
							$insertlistingSQL="INSERT INTO listings (ma_li_id, cat_id)
							VALUES ('".$refmaster_id."','".$categoryId1."')";
							Yii::$app->dbmtoa->createCommand($insertlistingSQL)->execute();				 
						}
				}
 				 $updateSQL = "UPDATE companies SET 
								ref_id = '".$ref_id."'
  								WHERE co_id = ".$id."";
 				Yii::$app->db->createCommand($updateSQL)->execute();
			}
			Yii::$app->session->setFlash('success','Information Saved Successfully');

            return $this->redirect(['index', 'id' => $model->co_id]);

        } else {

            return $this->render('create', [

                'model' => $model,

				'category' => $category,

            ]);
        }
    }
    /**
     * Updates an existing Companies model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $co_id
     * @return mixed
     */
	public function actionUpdate($id)
    {
		if (Yii::$app->user->isGuest)
		{
		return $this->redirect(['site/login']);
        }
		$filename = '';
        $model = $this->findModel($id);
		$catId1 = $model->cat_id = explode(',', $model->cat_id); 
		$catId = implode(",",$catId1);
		$filename = $model->contracts;
		$model->contracts = $filename;
		$sqlcat="select cat_id, cat_name from categories";
		//$sqlcat = "SELECT  cat_id,cat_name FROM `categories` WHERE `site_id` =1" ;
		$category = Yii::$app->db->createCommand($sqlcat)->queryAll();
		/*$category = [];

 foreach ($category2 as $group) {
     $category[$group['cat_id']] = $group['cat_name'];
 }
		*/
        if ($model->load(Yii::$app->request->post())) 
		{
			$contracts = UploadedFile::getInstance($model,'contracts');
			$data = Yii::$app->request->post();
			$cat_id = $data['Companies']['cat_id'];
			if(isset($cat_id) && !empty($cat_id))
			{
				$updateCid = implode(",",$cat_id);
				if(!empty($updateCid))
				{
						//$model -> cat_id = $catId.','.$updateCid;	
						$model -> cat_id = $updateCid;			
				}
			}
		
			if(isset($contracts))
			{
				if(isset($contracts -> tempName) && in_array($contracts->extension, array('jpg','pdf','png','gif')))
				{
					$contracts->saveAs(Yii::getAlias('@webroot/images/contracts/').'/'.$contracts->name);	
					$model->contracts = $contracts;
				}
			}
			else{
					$model->contracts = $filename;
				}
			$model->save();
			// Saving to refrence database starts
			$model = $this->findModel($id);
			$site_id = $model->site_id;
			$ref_id = $model->ref_id;
			$name = addslashes($model->name);
			$contact = $model->contact;
			$address1 = addslashes($model->address1);
			$address2 = addslashes($model->address2);
			$city = addslashes($model->city);
			$state = addslashes($model->state);
			$zipcode = $model->zipcode;
			$country = $model->country;
			$phone = $model->phone;
			$fax = $model->fax;
			$email = $model->email;
			$website = addslashes($model->website);
			$status = $model->status;
			if(($site_id>0)&&($site_id<7))
			{
				if($ref_id>0)
				{
					$updateSQL = "UPDATE companies SET 
								name = '".$name."',
								contact = '".$contact."',
								address1 = '".$address1."',
								address2 = '".$address2."',
								city = '".$city."',
								state = '".$state."',
								zipcode = '".$zipcode."',
								country = '".$country."',
								zipcode = '".$zipcode."',
								phone = '".$phone."',
								fax = '".$fax."',
								email = '".$email."',
								website = '".$website."',
								status = '".$status."'
								WHERE co_id = '".$ref_id."'";
					if($site_id == '1')
					{
						Yii::$app->dbasd->createCommand($updateSQL)->execute();
						
 						$sqlcatm="select * from master_listings where co_id='".$ref_id."'";
						$categorym= Yii::$app->dbasd->createCommand($sqlcatm)->queryAll();
 						$masterlistid=$categorym[0]['ma_li_id'];
						
						
						
 						foreach($cat_id as $catlist)
						{
							$categoryId = Categories::findOne($catlist);
 							$categoryId1=$categoryId['ref_id'];
							
							$sqllist="select * from  listings WHERE ma_li_id = '".$masterlistid."' AND cat_id = '".$categoryId1."'";
							$categoryml= Yii::$app->dbasd->createCommand($sqllist)->queryAll();
							if(count($categoryml)==0)
							{
							 $insertlistingSQL="INSERT INTO listings (ma_li_id, cat_id)
							VALUES ('".$masterlistid."','".$categoryId1."')";
							Yii::$app->dbasd->createCommand($insertlistingSQL)->execute();
							}
 							 
 						}
					}
					elseif($site_id == '2')
					{
					Yii::$app->dbmboa->createCommand($updateSQL)->execute();
					
					$sqlcatm="select * from master_listings where co_id='".$ref_id."'";
						$categorym= Yii::$app->dbmboa->createCommand($sqlcatm)->queryAll();
 						$masterlistid=$categorym[0]['ma_li_id'];
						
						
						
 						foreach($cat_id as $catlist)
						{
							$categoryId = Categories::findOne($catlist);
 							$categoryId1=$categoryId['ref_id'];
							
							$sqllist="select * from  listings WHERE ma_li_id = '".$masterlistid."' AND cat_id = '".$categoryId1."'";
							$categoryml= Yii::$app->dbmboa->createCommand($sqllist)->queryAll();
							if(count($categoryml)==0)
							{
							 $insertlistingSQL="INSERT INTO listings (ma_li_id, cat_id)
							VALUES ('".$masterlistid."','".$categoryId1."')";
							Yii::$app->dbmboa->createCommand($insertlistingSQL)->execute();
							}
 							 
 						}
						
					}
					elseif($site_id == '3')
					{
						Yii::$app->dbmbtoa->createCommand($updateSQL)->execute();
						
						$sqlcatm="select * from master_listings where co_id='".$ref_id."'";
						$categorym= Yii::$app->dbmbtoa->createCommand($sqlcatm)->queryAll();
 						$masterlistid=$categorym[0]['ma_li_id'];
						
						
						
 						foreach($cat_id as $catlist)
						{
							$categoryId = Categories::findOne($catlist);
 							$categoryId1=$categoryId['ref_id'];
							
							$sqllist="select * from  listings WHERE ma_li_id = '".$masterlistid."' AND cat_id = '".$categoryId1."'";
							$categoryml= Yii::$app->dbmbtoa->createCommand($sqllist)->queryAll();
							if(count($categoryml)==0)
							{
							 $insertlistingSQL="INSERT INTO listings (ma_li_id, cat_id)
							VALUES ('".$masterlistid."','".$categoryId1."')";
							Yii::$app->dbmbtoa->createCommand($insertlistingSQL)->execute();
							}
 							 
 						}
						
						
					}
				elseif($site_id == '4')
					{
						Yii::$app->dbmcoa->createCommand($updateSQL)->execute();
						
						$sqlcatm="select * from master_listings where co_id='".$ref_id."'";
						$categorym= Yii::$app->dbmcoa->createCommand($sqlcatm)->queryAll();
 						$masterlistid=$categorym[0]['ma_li_id'];
						
						
						
 						foreach($cat_id as $catlist)
						{
							$categoryId = Categories::findOne($catlist);
 							$categoryId1=$categoryId['ref_id'];
							
							$sqllist="select * from  listings WHERE ma_li_id = '".$masterlistid."' AND cat_id = '".$categoryId1."'";
							$categoryml= Yii::$app->dbmcoa->createCommand($sqllist)->queryAll();
							if(count($categoryml)==0)
							{
							 $insertlistingSQL="INSERT INTO listings (ma_li_id, cat_id)
							VALUES ('".$masterlistid."','".$categoryId1."')";
							Yii::$app->dbmcoa->createCommand($insertlistingSQL)->execute();
							}
 							 
 						}
						
					}

				elseif($site_id == '5')
					{

					Yii::$app->dbmoroa->createCommand($updateSQL)->execute();
					
					$sqlcatm="select * from master_listings where co_id='".$ref_id."'";
						$categorym= Yii::$app->dbmoroa->createCommand($sqlcatm)->queryAll();
 						$masterlistid=$categorym[0]['ma_li_id'];
						
						
						
 						foreach($cat_id as $catlist)
						{
							$categoryId = Categories::findOne($catlist);
 							$categoryId1=$categoryId['ref_id'];
							
							$sqllist="select * from  listings WHERE ma_li_id = '".$masterlistid."' AND cat_id = '".$categoryId1."'";
							$categoryml= Yii::$app->dbmoroa->createCommand($sqllist)->queryAll();
							if(count($categoryml)==0)
							{
							 $insertlistingSQL="INSERT INTO listings (ma_li_id, cat_id)
							VALUES ('".$masterlistid."','".$categoryId1."')";
							Yii::$app->dbmoroa->createCommand($insertlistingSQL)->execute();
							}
 							 
 						}

					}
					elseif($site_id == '6')
				{
						Yii::$app->dbmtoa->createCommand($updateSQL)->execute();
						
						$sqlcatm="select * from master_listings where co_id='".$ref_id."'";
						$categorym= Yii::$app->dbmtoa->createCommand($sqlcatm)->queryAll();
 						$masterlistid=$categorym[0]['ma_li_id'];
						
						
						
 						foreach($cat_id as $catlist)
						{
							$categoryId = Categories::findOne($catlist);
 							$categoryId1=$categoryId['ref_id'];
							
							$sqllist="select * from  listings WHERE ma_li_id = '".$masterlistid."' AND cat_id = '".$categoryId1."'";
							$categoryml= Yii::$app->dbmtoa->createCommand($sqllist)->queryAll();
							if(count($categoryml)==0)
							{
							 $insertlistingSQL="INSERT INTO listings (ma_li_id, cat_id)
							VALUES ('".$masterlistid."','".$categoryId1."')";
							Yii::$app->dbmtoa->createCommand($insertlistingSQL)->execute();
							}
 							 
 						}
					}

				}
			}

			// Saving to refrence database ends
			Yii::$app->session->setFlash('success','Information Updated Successfully');
            return $this->redirect(['index', 'id' => $model->co_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
				'category' => $category
            ]);
        }
    }

    /**
     * Deletes an existing Companies model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		if (Yii::$app->user->isGuest)



		{



		return $this->redirect(['site/login']);



        }



        $this->findModel($id)->delete();



		Yii::$app->session->setFlash('success', 'Information Deleted Successfully');



        return $this->redirect(['index']);



    }



	



	public function actionImportcsv()



    {



		if (Yii::$app->user->isGuest)



		{



		return $this->redirect(['site/login']);



        }



		 



     $model = new Companies();



    



    if ($model->load(Yii::$app->request->post())) {



		 



		 



		 



       $file = UploadedFile::getInstance($model, 'file'); 



	 



        $filename = 'Data.' . $file->extension;



        $upload = $file->saveAs('uploads/' . $filename);







        if ($upload) {







            define('CSV_PATH', 'uploads/');



            $csv_file = CSV_PATH . $filename;



			 $cnt = 0;



            $filecsv = file($csv_file);



 



           foreach ($filecsv as $data) {



			     if ($cnt!=0){



                $modelnew = new Companies();



                $hasil = explode(",", $data);



                $name= $hasil[0];



                $contact= $hasil[1];



                $title= $hasil[2];



                $address1= $hasil[3];



                $address2= $hasil[4];



                $city= $hasil[5];



                $state= $hasil[6];



                $zipcode = $hasil[7];



                $country = $hasil[8];



				$phone = $hasil[9];



				$fax = $hasil[10];



				$email = $hasil[11];



				$website = $hasil[12];



				$status = $hasil[13];



				$viewed = $hasil[14];



                $modelnew->name = $name;



                $modelnew->contact = $contact;



                $modelnew->title = $title;



                $modelnew->address1 = $address1;



                $modelnew->address2 = $address2;



                $modelnew->city = $city;



                $modelnew->state = $state;



                $modelnew->zipcode = $zipcode;



                $modelnew->country = $country; 



				$modelnew->phone = $phone;



				$modelnew->fax = $fax;



				$modelnew->email = $email;



				$modelnew->website = $website;	



				$modelnew->status = $status;



				$modelnew->viewed = $viewed;



				$modelnew->site_id = $model->site_id;



				$modelnew->save(false);



			 }



					 $cnt++;



				              



            }



			 



            //unlink('uploads/'.$filename);



            return $this->redirect(['companies/index']);



        }



    }else{



        return $this->render('importcsv',['model'=>$model]);



    }



    return $this->redirect(['importcsv']);



}







// for comments



public function actionComments($co_id)



    {



		if (Yii::$app->user->isGuest)



		{



		return $this->redirect(['site/login']);



        }



        $model = new Comments();



		/*$comments1 = Comments::find()



		   ->where(['co_id' => $co_id])



		  ->orderBy(['id'=>SORT_DESC])



		  ->all();*/



		  $sql="select * from user join company_notes on user.id=company_notes.userid where company_notes.co_id='".$co_id."' ORDER BY company_notes.id ASC";



		$comments1= Yii::$app->db->createCommand($sql)->queryAll();



		



         if ($model->load(Yii::$app->request->post()))



			{



 		   $model->userid=Yii::$app->user->id;



		   $model->co_id=$co_id;



			$model->save();



			Yii::$app->session->setFlash('success','Information Saved Successfully');



 			 return $this->redirect(['comments', 'co_id' => $model->co_id]);



        } else {



            return $this->render('comments', ['model' => $model,'comments1' => $comments1,   ]);



        }



    }



	



	 



    /**



     * Finds the Companies model based on its primary key value.



     * If the model is not found, a 404 HTTP exception will be thrown.



     * @param integer $id



     * @return Companies the loaded model



     * @throws NotFoundHttpException if the model cannot be found



     */



    protected function findModel($id)



    {



		if (Yii::$app->user->isGuest)



		{



		return $this->redirect(['site/login']);



        }



        if (($model = Companies::findOne($id)) !== null) {



            return $model;



        } else {



            throw new NotFoundHttpException('The requested page does not exist.');



        }



    }

	public function actionGetdrop()

	{

		 if(Yii::$app->request->isAjax)

		 {

				$data= Yii::$app->request->post(); 

				$siteName = $data['siteName'];

				$sql = "SELECT  cat_id,cat_name FROM `categories` WHERE `site_id` =".$siteName ;

				$result = Yii::$app->db->createCommand($sql)->queryAll(); 

				//print_r($result);

			if($result)

			{

				$search = // your logic;

				\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

				return [

					'result' => $result

				];

			}

			else

			{

				echo 'Failed';

			}  

						

         } 

	}



}



