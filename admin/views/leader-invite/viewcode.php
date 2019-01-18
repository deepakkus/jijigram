<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model admin\models\LeaderInvite */

$this->title = 'Register Code';
$this->params['breadcrumbs'][] = ['label' => 'Leader Invites', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<p>
        <?= Html::a('Back To List', ['index'], ['class' => 'btn btn-success']) ?>
    </p>
<div class="leader-invite-view">
<p>
<h4> 
Please click this link to register as leader on jijigram.com </h4>
<a target="_blank" href="http://www.jijigram.com/site/leader-signup"> http://www.jijigram.com/site/leader-signup </a> <br /> 
Use code : <?= $code;?>
</p>
    

</div>
