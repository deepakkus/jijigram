<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use admin\models\NominatedLeaderDetails;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel admin\models\LeaderInviteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nominate Leader Lists';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->session->hasFlash('success')): ?>
  <div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-check"></i>Saved!</h4>
  <?= Yii::$app->session->getFlash('success') ?>
  </div>
<?php endif; ?>
<div class="leader-invite-index">

    <h1><?php /*?><?= Html::encode($this->title) ?><?php */?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php /*?><?= Html::a('Create Leader Invite', ['create'], ['class' => 'btn btn-success']) ?><?php */?>
    </p>
	
<?php
//$sql = "SELECT FID FROM `nominated_leader_details` WHERE `nominated_leader_id` = 1";
$sql = "SELECT DISTINCT(nominated_leader_id), id, FID FROM nominated_leader_details group BY `nominated_leader_id`";
 $query  =  NominatedLeaderDetails::findBySql($sql);
$dataProvider = new ActiveDataProvider([
    //'query' => NominatedLeaderDetails::find(),
	'query' => $query,
    'pagination' => [
        'pageSize' => 20,
    ],
]);

echo GridView::widget([
    'dataProvider' => $dataProvider,
	'columns' => [
       
        // Simple columns defined by the data contained in $dataProvider.
        // Data from the model's column will be used.
        //'id',
		[
				'attribute' => 'nominated_leader_id',
				//'format' => 'text',
				'value' => function($data){
                     // return $data->user->first_name;
					 //return $data->user?$data->user->first_name:$data->userId;
					 return $data->nominate ? $data->nominate->leader_name : '';
                   },
				//'filter'=> ['empty'=>'Select User',$listData],
			],
			[
			  'attribute' => 'nominated_leader_id',
			  'header' => 'Total Nominated(As Leader)',
			  'filter' => false,
			  //'format' => 'text',
			   'value' => function($data) {
				    $nominateDetails = new NominatedLeaderDetails();
					$counttotal = $nominateDetails->getNominateTotal($data->nominated_leader_id); //NominatedLeaderDetails is my model,
                  return $counttotal;
				 },
			],
		[
				'attribute' => 'FID',
				'format' => 'raw',
				'value' => function($data){
                     // return $data->user->first_name;
					 //return $data->user?$data->user->first_name:$data->userId;
					// return $data->user ? $data->user->first_name : '';
					 //return '<a href="#">User List</a>';
					 return Html::a('User List',['nominated-leader-details/user-list', 'id' =>$data->nominated_leader_id],['target' => '_blank']);
                   },
				//'filter'=> ['empty'=>'Select User',$listData],
			],
        // More complex one.
       /* [
            'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
            'value' => function ($data) {
                return $data->name; // $data['name'] for array data, e.g. using SqlDataProvider.
            },
        ],*/
		
		 [
          'class' => 'yii\grid\ActionColumn',
          'header' => 'Nomination',
          'headerOptions' => ['style' => 'color:#337ab7'],
          'template' => '{nominate_leader}',
          'buttons' => [
            'nominate_leader' => function ($url, $data) {
				 $nominateDetails = new NominatedLeaderDetails();
					$counttotal = $nominateDetails->getNominateTotal($data->nominated_leader_id); //NominatedLeaderDetails is my model,
                    if($counttotal == 2)
				    {
                	return Html::a('Make As Ledader', ['nominated-leader-details/nominate-leader', 'id' =>$data->nominated_leader_id], [
                           'class' => 'btn btn-success', 'title' => Yii::t('app', 'nominate-leader')]);
				    }
            },
          ],
          ],
    ],
]);
?>
</div>
