<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model admin\models\LeaderInvite */

$this->title = 'Create Leader Invite';
$this->params['breadcrumbs'][] = ['label' => 'Leader Invites', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leader-invite-create">

    <h1><?php /*?><?= Html::encode($this->title) ?><?php */?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
