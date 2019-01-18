<?php



use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use manage\models\User;
use dosamigos\datepicker\DatePicker;
use dosamigos\datepicker\DateRangePicker;
use dosamigos\ckeditor\CKEditor;


/* @var $this yii\web\View */

/* @var $model manage\models\user */

/* @var $form yii\widgets\ActiveForm */

?>



<div class="user-form">



    <?php $form = ActiveForm::begin(); 
	//$createdDate = $model -> created_at;
 //echo date('Y-m-d', strtotime($createdDate));
	?>



    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>



    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>



    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>



    <?= $form->field($model, 'gender')->radioList(['M' => 'Male', 'F' => 'Female', ]) ?>
	<?php if(!$model->id){?>
		<?= $form->field($model, 'password_hash')->passwordInput() ?>
	<?php } ?>
    

	<?= $form->field($model, 'phone_no')->textInput() ?>
	
	<?= $form->field($model, 'show_contact_info')->radioList(array('Y'=>'Yes','N'=>'No')); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

<?= "<b>Date of Birth</b>"?>
<?= DatePicker::widget([
    'model' => $model,

    'attribute' => 'dob',
    'template' => '{addon}{input}',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-m-d'
        ]
]);?>



    <?= $form->field($model, 'address1')->textInput(['maxlength' => true]) ?>



    <?= $form->field($model, 'address2')->textInput(['maxlength' => true]) ?>



    <?php $items = ['0' => 'Afghanistan', '1' => 'Albania','2' => 'Bahamas', '3' => 'Bahrain', '4' =>'United States'];?>

    <?= $form->field($model, 'country')->dropDownList(

            User::getCountryNameLists(),           // array 

            ['prompt'=>'Select Your Country']    // options

        ); ?>



    <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>



    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>



    <?= $form->field($model, 'zip')->textInput(['maxlength' => true]) ?>



        <?= $form->field($model, 'user_pic')->fileInput(['multiple' => true, 'accept' => 'image/*']) ->label('Profile Picture');?>
        <?php if($model->user_pic!=''){?>
     		<img src="<?= Yii::$app->request->baseUrl.'/images/user/'.$model->user_pic ?>" height="100" width="200"/>
		<?php } ?>

   
	<?= $form->field($model, 'user_details')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) -> label('About Me');?>



    <?= $form->field($model, 'skill_level')->dropDownList([ 'B' => 'Beginner', 'I' => 'Intermediate', 'E' => 'Expert', 'S' => 'Scratch'], ['prompt' => 'Select Your Level']) ?>



    <?= $form->field($model, 'preferred_golf_course')->textInput(['maxlength' => true]) ?>



    <?= $form->field($model, 'other_courses')->radioList(array('Y'=>'Yes','N'=>'No')); ?>



    <?= $form->field($model, 'travel_mile_limit')->textInput(['maxlength' => true])-> label('Travel Mile Limit (Miles)'); ?>


 
<?= $form->field($model, 'available_date_range_from')->widget(DateRangePicker::className(), [
    'attributeTo' => 'available_date_range_to', 
    'form' => $form, // best for correct client validation
    'language' => 'en',
    'size' => 'lg',
    'clientOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-m-d'
    ]
]);?>

    	<?= $form->field($model, 'status')->radioList(['Y'=>'Active','N'=>'In-Active']); ?>





    <div class="form-group">

        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

    </div>



    <?php ActiveForm::end(); ?>



</div>

