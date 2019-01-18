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
	public $first_name;
	public $last_name;
	public $phone_no;
	public $gender;
	public $address1;
	public $state;
	public $city;
	public $zip;
	public $preferred_golf_course;
	public $travel_mile_limit;
	public $skill_level;


    /**
     * @inheritdoc
     */
     public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
   			[['first_name', 'last_name', 'gender'], 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
   //[['first_name', 'last_name', 'phone_no', 'dob', 'status', 'address1', 'address2', 'city','state', 'zip', 'country', 'user_pic', 'user_details','loc_lat', 'loc_long'], 'default', 'value' => null],
   			[['phone_no', 'address1', 'city','state', 'zip', 'country', 
			'user_pic', 'user_details', 'loc_lat', 'loc_long', 'skill_level', 
			'created_at', 'updated_at', 'address2', 'password_reset_token','auth_key' , 'other_courses',
			'preferred_golf_course',
			'travel_mile_limit', 'available_date_range', 'dob', 'status'], 'safe'],
			];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        /*if (!$this->validate()) {
            return null;
        }*/
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
		$user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
		$user->phone_no = $this->phone_no;
        $user->address1 = $this->address1;
		
        $user->gender = $this->gender;
		$user->state = $this->state;
        $user->city = $this->city;
		$user->zip = $this->zip;
        $user->travel_mile_limit = $this->travel_mile_limit;
		$user->skill_level = $this->skill_level;
        $user->preferred_golf_course = $this->preferred_golf_course;
		
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
