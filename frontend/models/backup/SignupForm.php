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
            ['username, first_name, last_name, gender, email', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
			[['gender','skill_level', 'preferred_golf_course'], 'string'],
            ['email', 'trim'],
            ['email', 'email'],
            ['email, address1, state, city, zip, travel_mile_limit', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
		
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
			[['phone_no', 'created_at', 'updated_at', 'loc_lat', 'loc_long'], 'integer'],
			[['phone_no'], 'string', 'min'=>10, 'message' => '{attribute} should be at least 10 digits'],
			//[['first_name', 'last_name', 'phone_no', 'dob', 'status', 'address1', 'address2', 'city','state', 'zip', 'country', 'user_pic', 'user_details','loc_lat', 'loc_long'], 'default', 'value' => null],
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
        $user->username = $this->username;
		//$user->first_name = $this->first_name;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
