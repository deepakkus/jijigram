<?php

namespace admin\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property int $nominated_leader_id
 * @property int $FID
  * @property string $addedon
 */
class NominatedLeaderDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nominated_leader_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           
			[['nominated_leader_id', 'FID', 'addedon', 'id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nominated_leader_id' => 'Nominated Leader',
            'FID' => 'Users',
			'addedon' => 'Date',
        ];
    }
	public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'FID']);
    }
	public function getNominate()
    {
        return $this->hasOne(NominateLeader::className(), ['id' => 'nominated_leader_id']);
    }
	public function getNominateTotal($id)
    {
        $sql = '
		SELECT count(ld.nominated_leader_id) as total, u.*
		FROM nominated_leader_details as ld
		INNER JOIN  nominated_leader as nl ON nl.id = ld.nominated_leader_id
		INNER JOIN  user as u ON u.id = ld.FID where nl.id = "'.$id.'"
		';
		$result = Yii::$app->db->createCommand($sql)->queryAll();
		$totalNominate = $result[0]['total']; 
		return $totalNominate;
    }
}
