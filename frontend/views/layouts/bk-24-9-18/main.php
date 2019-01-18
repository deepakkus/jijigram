<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use manage\models\Slider;
use manage\models\Settings;

AppAsset::register($this);

$this->registerCssFile("@web/css/style.css");
$this->registerCssFile("@web/bootstrap-css/bootstrap.min.css");
$this->registerCssFile("@web/bootstrap-css/bootstrap.css");
$this->registerCssFile("@web/bootstrap-css/bootstrap-theme.css");
$this->registerCssFile("@web/bootstrap-css/bootstrap-theme.min.css");
$this->registerCssFile("@web/css/font-awesome.min.css");
$this->registerCssFile("@web/css/font-awesome.css");
$this->registerCssFile("@web/css/owl.carousel.css");
$this->registerCssFile("@web/css/owl.theme.css");
$this->registerCssFile("@web/css/meanmenu.css");
$this->registerCssFile("@web/css/responsive.css");

$settings = Settings::findOne(['settings_id' => 1]);


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
  
</head>

<body>
<?php $this->beginBody() ?>
<header>
<link href="https://fonts.googleapis.com/css?family=Roboto:300,500,700" rel="stylesheet">
  <section class="header_bg sticky">
  <div class="header">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
          <div class="row">
            <div class="logo">
              <figure><a href="index.php"><img src="<?php echo Yii::$app->request->baseUrl;?>/images/logo.png" alt=""></a></figure>
            </div>
          </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
          <div class="row">
            
            <div class="menu">
              <nav>
                <ul>
                  <li class="<?php echo ((Yii::$app->controller->id=='site' && Yii::$app->controller->action->id=='index')? 'current_page_item' : '')?>"><a href="<?php echo Url::to(['site/index']);?>">Home</a></li>
				  
                  <li class="<?php echo ((Yii::$app->controller->id=='property')? 'current_page_item' : '')?>"><a href="<?php echo Url::to(['property/index']);?>">Featured Properties</a></li>
				  
                  <li class="<?php echo ((Yii::$app->controller->id=='real-estate')? 'current_page_item' : '')?>"><a href="<?php echo Url::to(['real-estate/index']);?>">Real Estate Expertise</a></li>
				  
                  <li class="<?php echo ((Yii::$app->controller->id=='charity')? 'current_page_item' : '')?>"><a href="<?php echo Url::to(['charity/index']);?>">Charity Choice Program</a></li>
				  
                  <li class="<?php echo ((Yii::$app->controller->id=='local-info')? 'current_page_item' : '')?>"><a href="<?php echo Url::to(['local-info/index']);?>">Local Information</a></li>
				  
                  <li class="<?php echo ((Yii::$app->controller->id=='contact')? 'current_page_item' : '')?>"><a href="<?php echo Url::to(['contact/index']);?>">Contact</a></li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section> 

</header>

<?= Breadcrumbs::widget([
	'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>
<?= Alert::widget() ?>
<?= $content ?>


<footer>
  <div class="footer_top">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> 
        <div class="about_f">
        <a href="#"><img src="<?php echo Yii::$app->request->baseUrl;?>/images/logo.png" alt=""></a>
        <p>Reinhard Real Estate is dedicated to building on an already successful 20 year foundation of providing concierge level service to everyone looking to buy or sell</p>
        <div class="social">
          <ul>
            <li><a title="Facebook" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a> </li>
            <li><a title="Twitter" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a> </li>
            <li><a title="Instagram" href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a> </li>
            <li><a title="Pinterest" href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a> </li>
    
          </ul>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
      <div class="quick_link">
        <h2>Sitemap</h2>
        <ul>
          <li><a href="<?php echo Url::to(['site/index']);?>">Home</a></li>
          <li><a href="<?php echo Url::to(['charity/index']);?>">Charity Choice Program</a></li>
          <li><a href="<?php echo Url::to(['property/index']);?>">Featured Properties</a></li>
          <li><a href="<?php echo Url::to(['local-info/index']);?>">Local Information</a></li>
          <li><a href="<?php echo Url::to(['contact/index']);?>">Contact</a></li>
          <li><a href="<?php echo Url::to(['real-estate/index']);?>">Real Estate Expertise</a></li>
        </ul>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
      <div class="contact_f">
        <h2>CONTACT INFO</h2>
        <div class="line"></div>
         <div class="adders"><i class="fa fa-map-marker" aria-hidden="true"></i>

          <p><?php echo $settings->contact_address;?></p>
        </div>
               <div class="coll"><i class="fa fa-phone" aria-hidden="true"></i><p><?php echo $settings->contact_phone;?></p></div>
 <div class="email"><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:<?php echo $settings->contact_email;?>"><?php echo $settings->contact_email;?></a></div>
 
 </div>
    </div>
  </div>
  </div>
</div>
<div class="footer_button">
<div class="container">
    <div class="row">
    <p><?php echo $settings->copyright;?>.</p>
    </div>
    </div>
</div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
<?php
$this->registerJsFile('@web/bootstrap-js/bootstrap.min.js');
$this->registerJsFile('@web/js/jquery.meanmenu.js');
$this->registerJsFile('@web/js/responsiveslides.min.js');
$this->registerJsFile('@web/js/owl.carousel.js');

?>
<script type="text/javascript">
  $(document).ready(function() {
	  jQuery('header nav').meanmenu();
	  	
  $("#slider1").responsiveSlides({
      
        speed: 800
      });
	var owl = $("#owl-demo");

      owl.owlCarousel();

      // Custom Navigation Events
      $(".next").click(function(){
        owl.trigger('owl.next');
      })
      $(".prev").click(function(){
        owl.trigger('owl.prev');
      })
      $(".play").click(function(){
        owl.trigger('owl.play',1000);
      })
      $(".stop").click(function(){
        owl.trigger('owl.stop');
      })
	  
	  
	  $("#owl-demo2").owlCarousel({
        items : 1,
        itemsCustom : false,
        itemsDesktop : [1199, 1],
        itemsDesktopSmall : [979, 1],
        itemsTablet : [768, 1],
        itemsTabletSmall : false,
        itemsMobile : [479, 1],
        lazyLoad : true,
        navigation : false,
		pagination : true,
		autoPlay : 4500
      });
  })
  

  

  jQuery(window).scroll(function(){
  var sticky = jQuery('.sticky'),
      scroll = jQuery(window).scrollTop();

  if (scroll >= 100) sticky.addClass('fixed');
  else sticky.removeClass('fixed');
  
  SyntaxHighlighter.all();
  
    
});


  </script>
  
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>