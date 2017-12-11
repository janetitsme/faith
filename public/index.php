<?php
require_once("../includes/session.php");
require_once("../includes/functions.php");
$page_title = 'Welcome to Faith Hair & Beauty';
include ("../includes/layouts/header.php");

?>
<script src="../includes/modernizr.js"></script>
<!-- jQuery -->
 <script src="../includes/jquery.min.js"></script>
 <link rel="stylesheet" type="text/css" href="stylesheets/style.css" media="all">			
		
  <script>window.jQuery || document.write('<script src="../includes/libs/jquery-1.7.min.js">\x3C/script>')</script>
  <!-- FlexSlider -->
  <link rel="stylesheet" href="stylesheets/flexslider.css" type="text/css" media="all" />
  <script defer src="../includes/jquery.flexslider.js"></script>
  <script type="text/javascript">
    $(function(){
      SyntaxHighlighter.all();
    });
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
  </script>
<div id=main>
<fieldset>
<H1>Welcome to Faith Hair & Beauty</H1>
<p align="left">Here at Faith Hair & Beauty we care about our clients. Have a browse through our reasonable but very relaxing treatments. We really hope you will like the service and like us on Facebook and follow us on twitter. We post our treatments offers and regularly update it.</p>
 </fieldset>
<div class="banner">
			<div class="flexslider">
	          <ul class="slides">
	            <li><img src="images/banner1.jpg" alt=""/></li>
	  	    	<li><img src="images/banner2.jpg"  alt=""/></li>
	  	    	<li><img src="images/banner3.jpg"  alt=""/></li>
	  	    	<li><img src="images/banner4.jpg"  alt=""/></li>
	          </ul>
	        </div>
	   </div>
	   
 <div class="wrap"> 
	       <div class="content-top">
				<div class="col_1_of_5 span_1_of_5">
					<img src="images/pic.jpg" alt="Body Massage" title="Flats">
					
					<div class="content1">
						<h4 class="title">Relaxation Massage</h4>
						<div class="morepad">
							<a href="underConstruction.php" class="btn">Read More</a>
						</div>
					</div>
				</div>
				<div class="col_1_of_5 span_1_of_5">
					<img src="images/pic1.jpg" alt="Hair Style" title="Flats">
					
					<div class="content2">
						<h4 class="title">Hair Styles</h4>
						<div class="morepad">
							<a href="underConstruction.php" class="btn">Read More</a>
						</div>
					</div>
				</div>
				<div class="col_1_of_5 span_1_of_5">
					<img src="images/pic2.jpg" alt="Hair Cut and colour" title="Flats">
					
					<div class="content3">
						<h4 class="title">Hair cut and colour</h4>
						<div class="morepad">
							<a href="underConstruction.php" class="btn1">Read More</a>
						</div>
					</div>
				</div>
				<div class="col_1_of_5 span_1_of_5">
					<img src="images/pic3.jpg" alt="css3" title="Eyebrows threading or waxing">
					
					<div class="content4">
						<h4 class="title">Threading / Waxing</h4>
						<div class="morepad">
							<a href="underConstruction.php" class="btn2">Read More</a>
						</div>
					</div>
				</div>
				<div class="col_1_of_5 span_1_of_5">
					
						<img src="images/pic4.jpg" alt="Herbal Facial" title="Flats">
					
					<div class="content5">
						<h4 class="title">Facial</h4>
						<div class="morepad">
							<a href="underConstruction.php" class="btn">Read More</a>
						</div>
					</div>
				</div>
				<div class="clear"></div>	
			</div>
</div>
<?php
include ("../includes/layouts/footer.php");
?> 