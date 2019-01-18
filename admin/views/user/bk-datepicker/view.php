<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model manage\models\user */

//$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?php /*?><?= Html::encode($this->title) ?><?php */?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'username',
            'first_name',
            'last_name',
            'gender',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            'phone_no',
			'show_contact_info',
            'status',
			[
				'attribute' => 'dob',
				'label' => 'Date Of Birth'
			],
            //'created_at',
           // 'updated_at',
            'address1',
            'address2',
            'country',
            'state',
            'city',
            'zip',
            'user_pic',
            //'strip_tags(user_details:ntext)',
			[
				'attribute' => 'user_details:ntext',
				'label' => 'About Me',
				'filter' => false,
				//'format' => 'raw',
				'value' => strip_tags($model->user_details),
			],
            'loc_lat',
            'loc_long',
            'skill_level',
            'preferred_golf_course:ntext',
            'other_courses',
            'travel_mile_limit',
            //'available_date_range_from',
			//'available_date_range_to',
			
        ],
    ]) ?>

</div>
