<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel manage\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->session->hasFlash('success')): ?>
  <div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-check"></i>Saved!</h4>
  <?= Yii::$app->session->getFlash('success') ?>
  </div>
<?php endif; ?>

<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	 <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'username',
            'first_name',
            'last_name',
           [
				'attribute' => 'gender',
				//'filter' => false,
				'format' => 'raw',
				'value' =>  function ($model) {
                    return ($model ->gender == 'F')? 'Female' : 'Male';
                },
			],
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            // 'email:email',
            // 'phone_no',
            // 'status',
            // 'dob',
            // 'created_at',
            // 'updated_at',
            // 'address1',
            // 'address2',
            // 'country',
            // 'state',
            // 'city',
            // 'zip',
            // 'user_pic',
            // 'user_details:ntext',
            // 'loc_lat',
            // 'loc_long',
            // 'skill_level',
            // 'preferred_golf_course:ntext',
            // 'other_courses',
            // 'travel_mile_limit',
            // 'available_date_range',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
