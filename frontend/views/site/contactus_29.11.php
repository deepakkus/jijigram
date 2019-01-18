<?php 
use yii\helpers\Html;
use yii\bootstrap\Alert;
use yii\bootstrap\ActiveForm;

$this->title = 'Contact us';
//$this->params['breadcrumbs'][] = $this->title;
$this->params['pass'] = 'active opened active';
//$this->registerCssFile("@web/css/bootstrap.min.css");
$this->registerCssFile("@web/css/font-awesome.min.css");
$this->registerCssFile("@web/css/line-awesome-font-awesome.min.css");
$this->registerCssFile("@web/css/line-awesome.css");
$this->registerCssFile("@web/css/style.css");
$this->registerCssFile("@web/css/responsive.css");
$this->registerCssFile("@web/css/animate.css");
$this->registerCssFile("@web/css/line-awesome-font-awesome.min.css");
$this->registerJsFile("@web/js/jquery.min.js");
$this->registerJsFile("@web/js/popper.js");
$this->registerJsFile("@web/js/bootstrap.min.js");
//$this->registerJsFile("@web/js/flatpickr.min.js");
$this->registerJsFile("@web/lib/slick/slick.min.js");
$this->registerJsFile("@web/js/script.js");
?>

<link rel="stylesheet" type="text/css" href="css/animate.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/line-awesome.css">
<link rel="stylesheet" type="text/css" href="css/line-awesome-font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="lib/slick/slick.css">
<link rel="stylesheet" type="text/css" href="lib/slick/slick-theme.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/responsive.css">
<link href="http://jijigram.com/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="http://jijigram.com/bootstrap-js/bootstrap.min.js"></script>
<link href="http://jijigram.com/css/line-awesome-font-awesome.min.css" rel="stylesheet">


<style>
.primary_bg_color{
    background: #732699 !important;
}

.opcity_bg{
    background: rgba(0,0,0,.5);
}

.form-check-input {
    margin-left: 0px;
    margin-top: 8px;
}

.btn-smbt {
    color: #fff;
    background-color: #732699;
    border-color: #551b71;
}

.pad-btm-30{
    padding-bottom: 30px;
}

.pb-4 {
    font-size: 28px;
}
.form-control {
    height: 45px;
    display: block;
    width: 100%;
    padding: 5px 10px;
    font-size: 16px;
    line-height: 1.25;
    color: #495057;
    background-color: #fff;
    background-image: none;
    background-clip: padding-box;
    border: 1px solid #732699;
    border-radius: .25rem;
    /* transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s; */
}
</style>

<body class="primary_bg_color">
<section class="testimonial py-5" id="testimonial">
    <div class="container">
        <div class="flx_row">
            <div class="col-lg-4 col-sm-12 col-xs-12 py-5 opcity_bg text-white text-center ">
                <div class=" ">
                    <div class="card-body">
                        <img src="<?= Yii::$app->request->baseUrl.'/images/'.'contact-icon.svg'; ?>" style="width:30%">
                        <h2 class="py-3">Contact us</h2>
                        <p>Tation argumentum et usu, dicit viderer evertitur te has. Eu dictas concludaturque usu, facete detracto patrioque an per, lucilius pertinacia eu vel.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-sm-12 col-xs-12 py-5 px-4 border bg-light">
                <h4 class="pb-4">Please fill with your details</h4>
                 <?php $form = ActiveForm::begin([ 'id' => 'signupForm']);?>
                <!--<form-->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                          <input id="Full Name" name="Full_Name" placeholder="Full Name" class="form-control" type="text" required="required">
                        </div>
                        <div class="form-group col-md-6">
                          <input type="email_id" name="email_id" class="form-control" id="inputEmail4" placeholder="Email" required="required">
                        </div>
                      </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input id="Mobile No." name="Mobile_No" placeholder="Mobile No." class="form-control" required="required" type="text">
                        </div>
                        <div class="form-group col-md-6">
                                  
                                  <select id="inputState" class="form-control" name="inputState">
                                    <option selected>Choose ...</option>
                                    <option> New Buyer</option>
                                    <option> Auction</option>
                                    <option> Complaint</option>
                                    <option> Feedback</option>
                                  </select>
                        </div>
                        <div class="form-group col-md-12">
                                  <textarea id="comment" name="comment" cols="40" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <div class="form-group">
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                                  <label class="form-check-label" for="invalidCheck2">
                                    <small> By clicking Submit, you agree to our Terms & Conditions, Visitor Agreement and Privacy Policy.</small>
                                  </label>
                                </div>
                              </div>
                    
                          </div>
                    </div>
                    
                    <div class="form-row float-right">
                       <!-- <button type="button" class="btn btn-smbt">Submit</button-->
                        <?= Html::submitButton( 'Submit', ['class' => 'btn btn-smbt' , 'value'=>'Create']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                <!--</form>-->
            </div>
        </div>
    </div>
</section>



<section class="testimonial py-5" id="testimonial">
    <div class="container">
        <h1 class="text-center text-white pad-btm-30">Contact Address</h1>

        <div class="flx_row">
            <div class="col-lg-8 col-sm-12 col-xs-12 border bg-light">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3685.8757590212367!2d88.33108471443285!3d22.50884414098158!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0270ae194ee0e9%3A0x4ce217d1b03431a0!2sNew+Alipore+Petrol+Pump+-+HP!5e0!3m2!1sen!2sin!4v1543484483686" width="100%" height="365" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>

            <div class="col-lg-4 col-sm-12 col-xs-12 py-5 px-5 opcity_bg text-white">
                <h3>Address</h3>
                <hr align="left" style="background: #fff">
                <i class="fa fa-map-marker"></i> address<br>
                <h4 class="pt-2">Contact no</h4>
                <hr align="left" style="background: #fff">
                <i class="fa fa-phone-square" aria-hidden="true"></i> <a href="tel:+"> 123456 </a><br>
                <h4 class="pt-2">Email</h4>
                <hr align="left" style="background: #fff">
                <i class="fa fa-envelope"></i> <a href="">test@test.com</a><br>
            </div>
            
        </div>
    </div>
</section>







</body>