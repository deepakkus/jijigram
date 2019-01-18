<?php
use manage\models\Pages;
use yii\bootstrap\ActiveForm;
use yii\widgets\Breadcrumbs;
?>
<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = $pages-> title;
//$this->params['breadcrumbs'][] = $this->title;
$this->registerJs("
$(function(){
$( '#send_mail' ).click(function() {
  if(($('.name').val()).search(/\S/) == -1)
  {
		$('.nameError').html('Name can not be blank');
		$('.nameError').css('color','#a94442');
		$('.name').css('border-color','#a94442');
  }
  if(($('.lastname').val()).search(/\S/) == -1)
  {
		$('.lastnameError').html('Last Name can not be blank');
		$('.lastnameError').css('color','#a94442');
		$('.lastname').css('border-color','#a94442');
  }
  if(($('.message').val()).search(/\S/) == -1)
  {
	$('.messageError').html('Message can not be blank');
	$('.messageError').css('color','#a94442');
	$('.message').css('border-color','#a94442');
  }
  if(($('.phone').val()).search(/\S/) == -1)
  {
	$('.phoneError').html('Phone Number can not be blank');
	$('.phoneError').css('color','#a94442');
	$('.phone').css('border-color','#a94442');
  }
 
  if(!checkEmail($('.email').val()))
  {
  	$('.emailError').html('Sorry! Not a valid email');
	$('.emailError').css('color','#a94442');
	$('.email').css('border-color','#a94442');
  }
  if((($('.name').val()).search(/\S/) == -1) && (!checkEmail($('.email').val())))
  {
  	return false;
  }
  return true;
});
$('body').on('click', function(){
      //do some code here i.e
      if(($('.name').val()).search(/\S/) != -1)
	  {
	  	$('.messageError').html('');
		$('.name').css('border-color','');
	  }
	  if(($('.lastname').val()).search(/\S/) != -1)
	  {
	  	$('.lastnameError').html('');
		$('.lastname').css('border-color','');
	  }
	  if(($('.email').val()).search(/\S/) != -1)
	  {
	  	$('.emailError').html('');
		$('.email').css('border-color','');
	  }
	   if(($('.message').val()).search(/\S/) != -1)
  	   {
	  	$('.messageError').html('');
		$('.message').css('border-color','');
  	   }
	   if(($('.phone').val()).search(/\S/) != -1)
  	   {
	  	$('.phoneError').html('');
		$('.phone').css('border-color','');
  	   }
    });return true;
});

function checkEmail(email) 
{
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
 if (!filter.test(email)) 
 {
   return false;
 }
 else
  return true;
}
");
?>
<section class="banner banner_inner"><!--banner-->
  <ul>
    <li> <img src="images/inner-banner.jpg" alt="">
      <div class="text_bg">
        <div class="innertitle">
          <h1><?php echo $pages->title;?></h1>
        </div>
      </div>
    </li>
  </ul>
</section>


<div class="container_section"> 
<section class="inner_container">
      <div class="container">
      <div class="breadcrumbs">
    <?= Breadcrumbs::widget([
	'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>
    </div>
        <div class="col-md-8 col-md-8 col-sm-8 col-xs-12 ">
          <section class="contact">
     
        <h2>Reinhard Real Estate</h2>
        <p><?php echo $pages->description;?></p>
    <div class="adders">
         
            <div class="text_f">
              <p><span>Address:</span><?php echo $settings->contact_address;?></p>
              <p><span>Phone: </span><?php echo $settings->contact_phone;?></p>
              <p><span>Email: </span> <a href="mailto:<?php echo $settings->contact_email;?>"><?php echo $settings->contact_email;?></a></p>
            </div>
          </div>
          <div class="leave_message">
          <h2>Send us a message</h2>
            <?php echo Html::beginForm(['contact/email']);?>
             <div class="col-md-6 col-md-6 col-sm-6 col-xs-12"> 
             <input placeholder="Name*" name="name" value="" type="name" class="name">
              <div class="nameError"></div>
             </div>
               <div class="col-md-6 col-md-6 col-sm-6 col-xs-12"> 
               <input placeholder="Last name*" name="lastname" value="" type="name" class="lastname">
               <div class="lastnameError"></div>
              </div>
               <div class="col-md-6 col-md-6 col-sm-6 col-xs-12"> 
               <input placeholder="Email*" name="email" value="" type="email" class="email">
               <div class="emailError"></div>
               </div>
              <div class="col-md-6 col-md-6 col-sm-6 col-xs-12"> 
               <input placeholder="Phone number*" name="phone" value="" type="phone" class="phone">
               <div class="phoneError"></div>
               </div>
               <div class="col-md-12 "> 
              <textarea name="message" placeholder="Message*" cols="" rows="" class="message"></textarea>
               <div class="messageError"></div>
               </div>
                <div class="col-md-12 "> 
              <input name="" value="SEND MESSAGE" type="submit" id= "send_mail">
              </div>
             <?php Html::endForm(); ?>
          </div>
       
        
 
    </section>
  
        </div>
        
        <?= $this->render('//helper/sidebar') ?>
        
      </div>
    </section>
   
  <!--<div class="map">
    <div class="container">
    <h2>Get in touch</h2>
    <div class="boder"><img src="images/boder2.png"  alt=""></div>
    <p>orem Ipsum is simply dummy text of the printing and typestting industry. Lorem Ipsum has been the industry's</p>
    <a  href="contact.html"><span><i class="fa fa-map-marker" aria-hidden="true"></i></span></a>
    </div>
      <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3685.7796661478396!2d88.3257400149585!3d22.512448485213802!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0270aba21c8491%3A0x32bc8b8a1b897eb0!2s28%2C+New+Alipore+Rd%2C+Block+H%2C+New+Alipore%2C+Kolkata%2C+West+Bengal+700053!5e0!3m2!1sen!2sin!4v1472384648336" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe> 
    </div>-->
</div>