<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model admin\models\LeaderInvite */

$this->title = 'Update Leader Invite';
$this->params['breadcrumbs'][] = ['label' => 'Leader Invites', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="leader-invite-update">

    <h1><?php /*?><?= Html::encode($this->title) ?><?php */?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
