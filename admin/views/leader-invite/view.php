<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model admin\models\LeaderInvite */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Leader Invites', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="leader-invite-view">

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
    <?php 
	$form = ActiveForm::begin([
    'id' => 'leader_invite',
	// 'action' => Url::to('/site/leader-signup'),
]); 
?>
<?php /*?><?= Html::textInput('incode', '56', ['class' => 'form-control']); <?php */?>
<?php
$code = $model->code;

echo Html::hiddenInput('leaderinvitecode', $code);
?>
<?php ActiveForm::end() ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'email:email',
		   [
				'attribute' => 'status',
				'value' => function($data){
					 return $data->status == 'R' ? 'Registered' : 'Non-Registered';
                   },
				'format' => 'raw'
			],
			[
				'attribute' => 'code',
				'value' => function($model){
					//$url = "http://www.jijigram.com/site/leader-signup?id=".$model->id."";
					$url = "http://www.jijigram.com/site/leader-signup";
					
			       //echo Html::textInput('', 'You Can Copy Your Code For Sign Up -'.$model->code,['style'=>'width:50%;']);
					return Html::a(
                        '<p>Please click this link to register as leader on jijigram.com</p>', 
                        $url,
						['id' => 'other', 'target'=>'_blank']
						);
						/*return '<div id="other">
						  Trigger the handler
						</div>';*/
				},
				'format' => 'raw'
			],
          ],
    ]) ?>

</div>
