<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel admin\models\LeaderInviteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Leader Invites';
$this->params['breadcrumbs'][] = $this->title;

?>
<?php if (Yii::$app->session->hasFlash('success')): ?>
  <div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-check"></i>Saved!</h4>
  <?= Yii::$app->session->getFlash('success') ?>
  </div>
<?php endif; ?>
<?php if (Yii::$app->session->hasFlash('error')): ?>
  <div class="alert alert-error alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-check"></i>Error!!</h4>
  <?= Yii::$app->session->getFlash('error') ?>
  </div>
<?php endif; ?>
<div class="leader-invite-index">

    <h1><?php /*?><?= Html::encode($this->title) ?><?php */?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Leader Invite', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
   

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],
			
            //'id',
			'name',
            'email:email',
			[
				'attribute' => 'status',
				'format' => 'raw',
				'value' =>  function ($model) {
                    return ($model ->status == 'R')? 'Registered' : 'Non-Registered';
                },
				'filter'=> ['Y'=>'Active','N'=>'In-Active'],
			],
           // 'code',
			[
				'attribute' => 'code',
				'format' => 'raw',
				'filter' => false,
				'value' =>  function ($model) {
                   return  Html::a( 'View Code', ['leader-invite/viewcode','id'=>$model->id], ['class' => 'btn btn-success', 'id' => 'popupModal']);   										 
														   
                   }
			],
            [ 'class' => 'yii\grid\ActionColumn' ],
        ],
    ]); ?>
    
  
 
</div>
