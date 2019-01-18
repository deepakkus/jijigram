<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.form-group {
    margin-bottom: 10px;
}	

.help-block {
    display: block;
    margin-top: 5px;
    margin-bottom: 10px;
    color: #737373;
    position: absolute;
    top: 55px;

}
.chkb_remember {
    margin-left: 52px;
    position: absolute;
    top: 198px;
    width: 153px;
}
label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: bold;
    margin-left: -40px;
}
.form-control {
    border-color: #84b328;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    border: 2px solid #84b328;
}
</style>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <div class="row">
        <div class="col-lg-5">
        <div class="bg_sign up" ><!--start sign up-->
  <div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 log_mrg">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h5 class="text-center">
                        LOGIN / SIGN IN</h5>
                    <!--<form class="form form-signup" role="form">-->
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                 <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-lock "></span></span>
                                 <?= $form->field($model, 'password')->passwordInput() ?>

                        </div>
                    </div>
                    <span class="chkb_remember">
                     <?= $form->field($model, 'rememberMe')->checkbox() ?>
                     </span>
                </div>
                <div style="color:#999;margin:1em 26px">
                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                </div>
                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-sm cu_btn-primary btn-block', 'name' => 'login-button']) ?>
                </div>

                <!--<a href="#" class="btn btn-sm cu_btn-primary btn-block" role="button">
                    SUBMIT</a>--> 
                    <?php ActiveForm::end(); ?>
                    <!--</form>-->
            </div>
        </div>
    </div>
</div>
</div>    
        </div>
    </div>
</div>
