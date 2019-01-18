<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use admin\models\Country;

/* @var $this yii\web\View */
/* @var $searchModel admin\models\PoliticalPartySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->session->hasFlash('success')): ?>
  <div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-check"></i>Saved!</h4>
  <?= Yii::$app->session->getFlash('success') ?>
  </div>
<?php endif; ?>
<div class="political-party-index">

    <h1><?php /*?><?= Html::encode($this->title) ?><?php */?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Categories', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	<?php
	$country= Country ::find()->all();
	$listData=ArrayHelper::map($country,'id','name');
	?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
			[
				'attribute' => 'countryId',
				'format' => 'text',
				'value' => function($data){
                      return $data->country->name;
                   },
				'filter'=> ['empty'=>'Select Country',$listData],
			],
            [
				'attribute' => 'status',
				'format' => 'raw',
				'value' =>  function ($model) {
                    return ($model ->status == 'Y')? 'Active' : 'In-Active';
                },
				'filter'=> ['Y'=>'Active','N'=>'In-Active'],
			],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
