<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use sadovojav\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use admin\models\User;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model admin\models\Post */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs(
' $("#postForm").on("beforeSubmit",function (e) {
  var \$form = $(this);
 
  $.post{
	  \$form.attr("action"),
	   \$form.serialize()
	  }.done(function(result){
    if (result.message == success){
		console.log(result);
    
    }else{
       $.pjax.reload({container : #postF});
    }
	}).fail(function(){
		console.log("error");
		});
		return false;

});'

	
    );

?>

<div class="post-form">
<?php Pjax::begin(['id' => 'postForm']) ?>
    <?php $form = ActiveForm::begin(['id' => 'postForm',
	'enableClientValidation' => false,
	 'enableAjaxValidation' => true, 
	 'validateOnSubmit' => true]); ?>
	<?php
	$user= User::find()->all();
	$listData=ArrayHelper::map($user,'id','first_name');
	?>

    <?= $form->field($model, 'userId')->dropDownList($listData, ['prompt' => 'Select User']) ?>

    <?= $form->field($model, 'message')->textarea(['rows' => 6])->widget(CKEditor::className());?>
    
    <?= $form->field($model, 'imagename')->fileInput(['accept' => 'image/*','multiple' => true]) ?> 
  <span id="image-holder"> </span>
</div>
   
    <?php if($model->imagename!=''){?>
     		<div><img src="<?= Yii::$app->request->baseUrl.'/images/postImage/'.$model->imagename ?>" height="150" width="200"/></div>
		<?php } ?>
	
    
    <?= $form->field($model, 'videoname')->fileInput(['accept' => 'video/mp4', 'class' => 'file_multi_video', 'onchange'=>'document.getElementById("preview").src = window.URL.createObjectURL(this.files[0])']) ?>
    
     <?php if($model->videoname!=''){?>
      <video style="border:1px solid" id="preview" width="200" height="150" controls >
      	<source src="<?= Yii::$app->request->baseUrl.'/videos/postVideo/'.$model->videoname ?>" type="video/mp4">
      </video>   		
		<?php } ?>
   <!-- <input type="file"  onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">-->

<video id ="preview" width="200" height="150" controls>
  <source src="video.mp4" type="video/mp4">
  <source src="video.ogg" type="video/ogg">
 <source src="video.webm" type="video/webm">
Your browser does not support the video tag.
</video>


    <?= $form->field($model, 'status')->dropDownList([ 'Y' => 'Yes', 'N' => 'No', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'totalvotetodelete')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<?php yii\widgets\Pjax::end() ?>
</div>
