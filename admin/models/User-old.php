<?php
namespace admin\models;
use Yii;
use admin\models\State;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $phone_no
 * @property string $status 
 * @property string $project_id
 * @property string $dob
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $address1 
 * @property string $usertype
 * @property string $address2
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $zip
 * @property string $user_pic
 * @property string $user_details
 * @property integer $loc_lat
 * @property integer $loc_long
 * @property string $skill_level
 * @property string $preferred_golf_course
 * @property string $other_courses
 * @property string $travel_mile_limit
 * @property string $available_date_range
 * @property string $project_id
 
 * @property string $confirm_password
 */
	
class User extends \yii\db\ActiveRecord
{
	public $old_password;
	public $new_password;
	public $repeat_password;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return 
		 	[
			 
            [['username','password_hash', 'email','address1','usertype'], 'required'],
            [['status'], 'string'],
            [['phone_no'], 'integer'],
            [['available_date_range','project_id'], 'safe'],
            [['username', 'first_name', 'last_name', 'password_hash', 'password_reset_token', 'email',  'address2', 'country'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['confirm_password'], 'string', 'max' => 100],
            [['username'], 'unique'],
            [['email'], 'unique'],
			['email', 'email', 'message' => 'Please Enter valid e-mail'],
			['password_hash', 'string', 'min' => 5, 'message' => '{attribute} should be at least 6 symbols'],
            [['password_reset_token'], 'unique'],
			[['phone_no'], 'string', 'min'=>10, 'message' => '{attribute} should be at least 10 digits'],	
            [['show_contact_info', 'confirm_password', 'other_courses', 'preferred_golf_course', 'status', 'address1', 'available_date_range'], 'safe'],			
        ];
    }
	
public function findPasswords($attribute, $params)
	{
		$user = User::model()->findByPk(Yii::app()->user->id);
		if ($user->password != md5($this->old_password))
			$this->addError($attribute, 'Old password is incorrect.');
	}

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'phone_no' => 'Phone No',
			 
            'status' => 'Status',
           
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'address1' => 'Address', 
			'usertype' => 'User Type',
            'address2' => 'Address2',
            //'country' => 'Country',
            
            
			'state' => 'State',
			'nation' => 'Nation',
			'province'=> 'Province',
            'zip' => 'Zip',
            
            'user_details' => 'User Details',
            'loc_lat' => 'Loc Lat',
            'loc_long' => 'Loc Long',
            'skill_level' => 'Skill Level',
            'preferred_golf_course' => 'Preferred Golf Course',
            'other_courses' => 'Other Courses',
            'travel_mile_limit' => 'Travel Mile Limit',
            'available_date_range' => 'Available Date Range',
			'confirm_password' => 'confirm_password',
			
        ];
    }
	public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
	static function getCountryNameLists()
	{
	$items = ['0' => 'Afghanistan', '1' => 'Albania','2' => 'Algeria', '3' => 'Andorra', '4' =>'Angola', '5' => 'Antigua and Barbuda', '6' => 'Argentina', '7' => 'Armenia', 
	'8' => 'Aruba', '9' => 'Australia', '10' => 'Austria', '11' => 'Azerbaijan', '12' => 'The Bahamas', '13' => 'Bahrain' ,'14' => 'Bangladesh', '15' => 'Barbados', '16' => 'Belarus',
	'17' => 'Belgium', '18' => 'Belize', '19' => 'Benin', '20' => 'Bhutan', '21' => 'Bolivia', '22' => 'Bosnia and Herzegovina', '23' => 'Botswana', '24' => 'Brazil', '25' => 'Brunei',
	'26' => 'Bulgaria', '27' => 'Burkina Faso', '28' => 'Burma', '29' => 'Burundi', '30' => 'Cambodia' , '31' => 'Cameroon', '32' => 'Canada', '33' => 'Cabo Verde',
	 '34' => 'Central African Republic',
	'35' => 'Chad', '36' => 'Chile', '37' => 'China', '38' => 'Colombia', 
	'39' => 'Comoros', '40' => ' Republic of the Congo', '41' => 'Costa Rica', 
	'42' => 'Cote dIvoire',
	'43' => 'Croatia', '44' => 'Cuba', '45' => 'Curacao', '46' => 'Cyprus' , 
	'47' => 'Czechia', '48' => 'Denmark', '49' => 'Djibouti', '50' => 'Dominica', 
	'51' => 'Dominican Republic',
	'52' => 'East Timor', '53' => 'Ecuador', '54' => 'Egypt', '55' => 'El Salvador', 
	'56' => 'Equatorial Guinea', '57' => 'Eritrea', '58' => 'Estonia', '59' => 'Ethiopia', '60' => 'Fiji',
	'61' => 'Finland', '62' => 'France', '63' => 'Gabon', '64' => 'Gambia', '65' => 'Georgia', '66' => 'Germany', '67' => 'Ghana', '68' => 'Greece', '69' => 'Grenada', '70' => 'Guatemala',
	'71' => 'Guinea', '72' => 'Guinea-Bissau', '73' => 'Guyana', '74' => 'Haiti', '75' => 'Holy See', '76' => 'Honduras', '77' => 'Hong Kong', '78' => 'Hungary', '79' => 'Iceland'
	,'80' => 'India', '81' => 'Indonesia', '82' => 'Iran', '83' => 'Iraq', '84' => 'Ireland', '85' => 'Israel', '86' => 'Italy', '87' => 'Jamaica', '88' => 'Japan', '89' => 'Jordan',
	'90' => 'Kazakhstan', '91' => 'Kenya', '92' => 'Kiribati', '93' => 'North Korea', '94' => 'South Korea', '95' => 'Kosovo', '96' => 'Kuwait', '97' => 'Kyrgyzstan', '98' => 'Laos',
	'99' => 'Latvia', '100' => 'Lebanon', '101' => 'Lesotho', '102' => 'Liberia', '103' => 'Libya', '104' => 'Liechtenstein', '105' => 'Lithuania', '106' => 'Luxembourg',
	'107' => 'Macau', '108' => 'Macedonia', '109' => 'Madagascar', '110' => 'Malawi', '111' => 'Malaysia','112' => 'Maldives', '113' => 'Mali', '114' => 'Malta', '115' => 'Marshall Islands',
	'116' => 'Mauritania', '117' => 'Mauritius', '118' => 'Mexico', '119' => 'Micronesia', '120' => 'Moldova', '121' => 'Monaco', '122' => 'Mongolia', '123' => 'Montenegro', 
	'124' => 'Morocco', '125' => 'Mozambique', '126' => 'Namibia', '127' => 'Nauru', '128' => 'Nepal', '129' => 'Netherlands', '130' => 'New Zealand', '131' => 'Nicaragua', '132' => 'Niger',
	'133' => 'Nigeria', '134' => 'North Korea', '135' => 'Norway', '136' => 'Oman', '137' => 'Pakistan', '138' => 'Palau', '139' => 'Palestinian Territories', '140' => 'Panama', 
	'141' => 'Papua New Guinea', '142' => 'Paraguay', '143' => 'Peru', '144' => 'Philippines', '145' => 'Poland', '146' => 'Portugal', '147' => 'Qatar', '148' => 'Romania',
	'149' => 'Russia', '150' => 'Rwanda', '151' => 'Saint Kitts and Nevis', '152' => 'Saint Lucia', '153' => 'Saint Vincent and the Grenadines', '154' => 'Samoa', 
	'155' => 'San Marino', '156'  => 'Sao Tome and Principe', '157' => 'Saudi Arabia', '158' => 'Senegal', '159' => 'Serbia', '160' => 'Seychelles', '161' => 'Sierra Leone',
	'162' => 'Singapore', '163' => 'Sint Maarten', '164' => 'Slovakia', '165' => 'Slovenia', '166' => 'Solomon Islands', '167' => 'Somalia','168' => 'South Africa', '169' => 'South Korea', '170' => 'South Sudan', '171' => 'Spain', '172' => 'Sri Lanka', '173' => 'Sudan', '174' => 'Suriname', '175' => 'Swaziland',
	'176' => 'Sweden', '177' => 'Switzerland', '178' => 'Syria', '179' => 'Taiwan', '180' => 'Tajikistan', '181' => 'Tanzania', '182' => 'Thailand', '183' => 'Timor-Leste', 
	'184' => 'Togo', '185' => 'Tonga', '186' => 'Trinidad and Tobago', '187' => 'Tunisia', '188' => 'Turkey', '189' => 'Turkmenistan', '190' => 'Tuvalu', '191' => 'Uganda',
	'192' => 'Ukraine', '193' => 'United Arab Emirates', '194' => 'United Kingdom', '195' => 'United States of America (USA)', '196' => 'Uruguay', '197' => 'Uzbekistan', '198' => 'Vanuatu', '199' => 'Venezuela',
	'200' => 'Vietnam', '201' => 'Yemen','202' =>'Zambia','203' => 'Zimbabwe'];
	return $items;
	
	}
	static function getStateNameLists()
	{
		$state = State::find()->all();
		foreach($state as $val)
		{
			$statename[] =  $val -> name;
		
		}
		return $statename;
	
	}
}
