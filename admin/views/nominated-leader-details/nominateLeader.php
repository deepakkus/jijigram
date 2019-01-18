<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model admin\models\LeaderInvite */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Nominate Leader Details';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="leader-invite-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($user, 'email')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Nominate Leader', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
