<?php

namespace admin\models;

use Yii;

/**
 * This is the model class for table "leader_invite".
 *
 * @property int $id
 * @property string $email
 * @property string $status
 * @property string $code
 * @property string $name
 */
class LeaderInvite extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'leader_invite';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['email', 'status'], 'required'],
            [['status'], 'string'],
            [['email', 'code', 'name'], 'string', 'max' => 255],
			 [['email', 'status', 'code'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
			'name' => 'Name',
            'status' => 'Status',
            'code' => 'Code',
        ];
    }
	 /*public static function generateCodeKey()
   {
     	$length = 15;
		$chars = array_merge(range(0,9), range('a','z'), range('A','Z'));	
		shuffle($chars);	
		$code = implode(array_slice($chars, 0, $length));
		echo $code;
    }*/
	public function generateCodeKey()
    {
		$length = 6;
        $this->code = Yii::$app->security->generateRandomString($length);
    }
}
