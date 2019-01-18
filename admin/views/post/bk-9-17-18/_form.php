<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use sadovojav\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use admin\models\User;

/* @var $this yii\web\View */
/* @var $model admin\models\Post */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs(

    '$("document").ready(function(){
		 $("#post-imagename").on("change", function() {			 
          //Get count of selected files
          var countFiles = $(this)[0].files.length; 
          var imgPath = $(this)[0].value; 
          var extn = imgPath.substring(imgPath.lastIndexOf(".") + 1).toLowerCase();
          var image_holder = $("#image-holder");
          image_holder.empty();
          if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof(FileReader) != "undefined") {
              //loop for each file selected for uploaded.
              for (var i = 0; i < countFiles; i++) 
              {
                var reader = new FileReader();
                reader.onload = function(e) {
                  $("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image",
					 "height": 200,
					  "width": 200,
                  }).appendTo(image_holder);
                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[i]);
              }
            } else {
              echo (image_holder);
            }
          } else {
            //alert ("Pls select only images");
          }
        
			  });
		});'
    );

?>

<div class="post-form">
    <?php $form = ActiveForm::begin(); ?>
	<?php
	$user= User::find()->all();
	$listData=ArrayHelper::map($user,'id','first_name');
	?>

    <?= $form->field($model, 'userId')->dropDownList($listData, ['prompt' => 'Select User']) ?>

    <?= $form->field($model, 'message')->textarea(['rows' => 6])->widget(CKEditor::className());?>
    
    <?= $form->field($model, 'imagename')->fileInput(['accept' => 'image/*']) ?><span id="image-holder"> </span>
   
    <?php if($model->imagename!=''){?>
     		<div><img src="<?= Yii::$app->request->baseUrl.'/images/postImage/'.$model->imagename ?>" height="150" width="200"/></div>
		<?php } ?>
	
    
    <?= $form->field($model, 'videoname')->fileInput(['accept' => 'video/mp4', 'class' => 'file_multi_video']) ?>
    
     <?php if($model->videoname!=''){?>
      <video style="border:1px solid" id="myVideo" width="200" height="150" controls >
      	<source src="<?= Yii::$app->request->baseUrl.'/videos/postVideo/'.$model->videoname ?>" type="video/mp4">
      </video>   		
		<?php } ?>
    
    <?= $form->field($model, 'status')->dropDownList([ 'Y' => 'Yes', 'N' => 'No', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'totalvotetodelete')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
