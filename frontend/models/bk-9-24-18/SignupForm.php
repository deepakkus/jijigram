<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
	public $confirm_password;
	public $first_name;
	public $last_name;
	public $phone_no;
	public $gender;
	public $address1;
	public $city;
	public $state;
    public $nation;
	public $province;
	public $zip;
	public $preferred_golf_course;
	public $travel_mile_limit;
	public $skill_level;
	public $dob;


    /**
     * @inheritdoc
     */
     public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
   			[['first_name', 'last_name', 'gender'], 'required'],
			['address1', 'required', 'message' => 'Address cannot be blank.'],

            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            [['password', 'confirm_password'],'required', 'on' => 'signup'],
            ['password', 'string', 'min' => 6],
			['confirm_password', 'required'],
			['confirm_password', 'compare', 'compareAttribute'=>'password', 'message'=>"Password and Confirm Password Does not match." ],
			[['phone_no', 'address1', 'city','state', 'zip', 'country','nation','province', 
			'user_pic', 'user_details', 'loc_lat', 'loc_long', 'skill_level', 
			'created_at', 'updated_at', 'address2', 'password_reset_token','auth_key' , 'other_courses',
			'preferred_golf_course',
			'travel_mile_limit', 'available_date_range', 'status', 'dob'], 'safe'],
			];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
		//$model->scenario = 'signup';
        $user->username = $this->username;
        $user->email = $this->email;
		$user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
		$user->phone_no = $this->phone_no;
        $user->address1 = $this->address1;
		$user->confirm_password = $this->confirm_password;
        $user->gender = $this->gender;
		$user->city = $this->city;
		$user->state = $this->state;
        $user->nation = $this->nation;
		$user->province = $this->province;
		$user->zip = $this->zip;
        $user->travel_mile_limit = $this->travel_mile_limit;		
        $user->preferred_golf_course = $this->preferred_golf_course;
		$expdob = explode("-", $this -> dob);
		$user -> dob = date("Y-m-d",strtotime($expdob[2]."-".$expdob[0]."-".$expdob[1]));

		if ($this->skill_level)
		{
			$user->skill_level = $this->skill_level;	
		}
		else
		{
			$user -> skill_level = 'B';	
		}
		
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
		 $url = "http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($user -> address1)."&sensor=false";
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
			$user -> loc_lat = $lat;
			$user -> loc_long = $long;
		
        return $user->save() ? $user : null;
    }
}
