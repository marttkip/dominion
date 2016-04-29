<?php 
	if(count($contacts) > 0)
	{
		$email = $contacts['email'];
		$phone = $contacts['phone'];
		$facebook = $contacts['facebook'];
		$twitter = $contacts['twitter'];
		$linkedin = $contacts['linkedin'];
		$logo = $contacts['logo'];
		$company_name = $contacts['company_name'];
		$address = $contacts['address'];
		$city = $contacts['city'];
		$post_code = $contacts['post_code'];
		$building = $contacts['building'];
		$floor = $contacts['floor'];
		$location = $contacts['location'];
		$working_weekend = $contacts['working_weekend'];
		$working_weekday = $contacts['working_weekday'];
		
		if(!empty($email))
		{
			$mail = '<div class="top-number"><p><i class="fa fa-envelope-o"></i> '.$email.'</p></div>';
		}
		
		if(!empty($facebook))
		{
			$facebook = '<li><a href="'.$facebook.'" target="_blank"><i class="fa fa-facebook"></i></a></li>';
		}
		
		if(!empty($twitter))
		{
			$twitter = '<li><a href="'.$twitter.'" target="_blank"><i class="fa fa-twitter"></i></a></li>';
		}
		
		if(!empty($linkedin))
		{
			$linkedin = '<li><a href="'.$linkedin.'" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
		}
	}
	else
	{
		$email = '';
		$facebook = '';
		$twitter = '';
		$linkedin = '';
		$logo = '';
		$company_name = '';
	}
?>
   <!-- Start Page Header -->
    <div class="page-header parallax clearfix">
        <div id="contact-map"></div>
    </div>
    <!-- End Page Header -->
    <!-- Breadcrumbs -->
    <div class="lgray-bg breadcrumb-cont">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url()?>home">Home</a></li>
                <li class="active">Contact</li>
            </ol>
        </div>
    </div>
    <!-- Start Body Content -->
    <div class="main" role="main">
        <div id="content" class="content full">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-5">
                        <h2>Our Locations</h2>
                        <hr class="sm">
                        <h4 class="short accent-color">Texas, Unites States</h4>
                        <p>777, path to God<br>1800-989-990<br><a href="mailto:us@adorechurch.com">us@adorechurch.com</a></p>
                        <hr class="fw cont">
                        <h4 class="short accent-color">London</h4>
                        <p>777, path to God<br>1800-989-990<br><a href="mailto:uk@adorechurch.com">uk@adorechurch.com</a></p>
                        <hr class="fw cont">
                        <h4 class="short accent-color">Toronto</h4>
                        <p>777, path to God<br>1800-989-990<br><a href="mailto:ca@adorechurch.com">ca@adorechurch.com</a></p>
                    </div>
                    <div class="col-md-8 col-sm-7">
                        <form method="post" id="contactform" name="contactform" class="contact-form clearfix" action="mail/contact.htm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" id="fname" name="First Name"  class="form-control input-lg" placeholder="First name*">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" id="lname" name="Last Name"  class="form-control input-lg" placeholder="Last name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" id="email" name="email"  class="form-control input-lg" placeholder="Email*">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" id="phone" name="phone" class="form-control input-lg" placeholder="Phone">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea cols="6" rows="7" id="comments" name="comments" class="form-control input-lg" placeholder="Message"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input id="submit" name="submit" type="submit" class="btn btn-primary btn-lg btn-block" value="Submit now!">
                                </div>
                            </div>
                        </form>
                        <div class="clearfix"></div>
                        <div id="message"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Body Content -->
    

<script type="text/javascript"   src="http://maps.google.com/maps/api/js?sensor=false"> </script>

<script type="text/javascript">
$(document).ready(function() {
	initialize()
});
  function initialize() {
    var position = new google.maps.LatLng('-1.295977', '36.808225');
	 <!-- var position = new google.maps.LatLng(latitude, longitude);-->
    var myOptions = {
      zoom: 18,
      center: position,
      mapTypeId: google.maps.MapTypeId.ROADMAP
		//mapTypeId: google.maps.MapTypeId.HYBRID
    };
    var map = new google.maps.Map(
        document.getElementById("map_canvas"),
        myOptions);
 
    var marker = new google.maps.Marker({
        position: position,
        map: map,
        title:"<?php echo $company_name;?>"
    });  
 
   var contentString = '<br/><span itemprop="streetAddress"><?php echo $company_name;?></span>, <span itemprop="addressLocality"><?php echo $building.', '.$floor;?></span>';
    //var contentString = '';
    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });
       infowindow.open(map,marker);
    google.maps.event.addListener(marker, 'click', function() {
      infowindow.open(map,marker);
    });
 
  }
 
</script>
