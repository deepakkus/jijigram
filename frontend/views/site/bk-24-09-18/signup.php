<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use manage\models\User;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs("
$(function(){
$( '#signupform-nation' ).change(function() {
		if($('#signupform-nation :selected').text() != 'United States of America (USA)')	
		{
		   $('.province-name').attr('style', 'display:block');
		}
		else{
			$('.province-name').attr('style', 'display:none');
		}
		
});
});");
?>
<div class="row">
<div class="site-signup">
    <h1><?php /*?><?= Html::encode($this->title) ?><?php */?></h1>
    <div class="row">
 
           <div class="bg_container" ><!--start bg_container-->
  <div class="container">
  
      <div class="row centered-form">
        <div class="col-xs-12 col-sm-6 col-md-6 col-md-6" > <img class="img-responsive" src="images/reg2.png"> </div>
        <div class="col-xs-12 col-sm-6 col-md-6 zcol-sm-offset-6 zcol-md-offset-6"> 
          
          <!--start panel-->
          <div class="panel panel-default">
            <div class="panel-heading">
              <p><span>Yes, it really is free</span></p>
              <h2 class="panel-title">Please sign up for golf buddy wanted</h2>
            </div>
            <div class="panel-body">
             <!-- <form role="form">-->
              <?php $form = ActiveForm::begin();?>
              	<div class="form-group ">
                  <label for="Address">Personal Details</label>
                </div>
                <div class="form-group">
                   <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                      <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                      <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
                    </div>
                  </div>
                </div>
                
                <div class="form-group">
                	<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                    	<?= $form->field($model, 'password')->passwordInput() ?>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                    	<?= $form->field($model, 'confirm_password')->passwordInput() ?>
                    `	<?php /*?><?= Html::label('Confirm password');?><?php */?>
                        <?php /*?><?= Html::input('password', 'password', '', ['class' => 'form-control']) ?><?php */?>
                    </div>
                  </div>
                </div>
                <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                      <?= $form->field($model, 'phone_no')->textInput() ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                       <?= $form->field($model, 'gender')->radioList(['M' => 'Male', 'F' => 'Female', ]) ?>
                  </div>
                </div>
                </div>
                <div class="form-group ">
                     <?= $form->field($model, 'dob')->textInput()->label('Date-Of-Birth(mm-dd-yyyy)'); ?>
				</div>
              <div class="form-group ">
                  <label for="Address">Address</label>
<?php ?>        <?= $form->field($model, 'address1')->textInput(['maxlength' => true])-> label(false); ?>
<?php ?>                </div>
                <div class="form-group col-sm-5">
                  <div class="row">
                   <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
                </div>
                </div>
                <div class="form-group col-sm-5">
                <div class="row">
                    <?php /*?><?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?><?php */?>
                    <?= $form->field($model, 'state')->dropDownList(
                    
                                User::getStateNameLists(),           // array 
                    
                                ['prompt'=>'Select Your State']    // options
                    
                            ); ?>   
                  </div> </div>
				<div class="pr_col-sm-12 col-sm-12">
				     <div class="form-group col-sm-5">
                     <div class="row">
                    <?php /*?><?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?><?php */?>
                    <?= $form->field($model, 'nation')->dropDownList(
                    
                               User::getCountryNameLists(),           // array 
                    
                                ['prompt'=>'Select Your Nation']    // options
                    
                            ); ?>  
                </div>
				</div>				
                <div class="form-group col-sm-5 col-xs-12 province-name" style="display:none">
                   <?= $form->field($model, 'province')->textInput(['maxlength' => true]) ?>							
                  </div>
				  
				  </div>
				  <div>
                <div class="form-group col-sm-5">
                  <div class="row">
                     <?= $form->field($model, 'zip')->textInput(['maxlength' => true]) ?>
                  </div>
                </div>
                <div class="clearfix"></div>
                </div>
                <div class="form-group">                
                  <?= $form->field($model, 'preferred_golf_course')->textInput() ?>				  
                <div class="form-group">
                  		<?php $items = ['0' => 20, '1' => 30,'2' => 40, '3' => 50, '4' =>100, '5' =>150];?>
                  		<?= $form->field($model, 'travel_mile_limit')->dropDownList($items,// array 
            			['prompt'=>'Select Your Travel Miles']) -> label('Travel Mile Limit (Miles)'
						); ?> 
                  <span id="error_gender" class="text-danger"></span> </div>
                <div class="form-group">
                      <?= $form->field($model, 'skill_level')->dropDownList([ 'S' => 'Scratch', 'B' => 'Beginner', 'I' => 'Intermediate', 'E' => 'Expert','T' => 'Better Than Expert'], ['prompt' => 'Select Your Level']) ?>                  
                  <span id="error_gender" class="text-danger"></span> </div>
        			<?= Html::submitButton('Sign-Up' , ['class' => 'btn btn-sm cu_btn-primary btn-block']) ?>
                 <?php ActiveForm::end(); ?>
              <!--</form>-->
            </div>
          </div>
          <!--end panel--> 
        </div>
      </div>   
  </div>
</div>
    
    </div>
</div>

</div>