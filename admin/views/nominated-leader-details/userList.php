<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use admin\models\User;
use admin\models\NominatedLeaderDetails;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model admin\models\LeaderInvite */

	echo GridView::widget([
    'dataProvider' => $dataProvider,
	'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
       // 'first_name',
		[
				'attribute' => 'first_name',
				'header' => 'User Name',
			],
    ],
]);
		
?>

</div>
