<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use admin\models\Country;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model admin\models\PoliticalParty */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="political-party-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
 <?php
    //use app\models\Country;
	$countries= Country::find()->all();
	
	//use yii\helpers\ArrayHelper;
	$listData=ArrayHelper::map($countries,'id','name');
	?>
    <?= $form->field($model, 'countryId')->dropDownList($listData, ['prompt' => 'Select Country']) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Y' => 'Active', 'N' => 'IN-Active', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

