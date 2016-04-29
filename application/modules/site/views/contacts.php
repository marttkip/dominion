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
                        <h2>Our Location</h2>
                        <hr class="sm">
                        <h4 class="short accent-color">Haile selasse Road </h4>
                        <p>Opp Thika School for the blind,, <br> P.O Box 2201 Thika 01000<br><a href="mailto:info@dominiongenerations.org">info@dominiongenerations.org</a></p>
                    </div>
                    <div class="col-md-8 col-sm-7">
                        <form method="post" id="contactform" name="contactform" class="contact-form clearfix" action="#">
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
var geocoder = new google.maps.Geocoder();
var address = "Haile selasse Road ,Opp Thika School for the blind P.O Box 2201 Thika 01000"; //Add your address here, all on one line.
var latitude;
var longitude;
var color = "#3bafda"; //Set your tint color. Needs to be a hex value.

function getGeocode() {
    geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            latitude = results[0].geometry.location.lat();
            longitude = results[0].geometry.location.lng(); 
            initGoogleMap();   
        } 
    });
}

function initGoogleMap() {
    var styles = [
        {
          stylers: [
            { saturation: -100 }
          ]
        }
    ];
    
    var options = {
        mapTypeControlOptions: {
            mapTypeIds: ['Styled']
        },
        center: new google.maps.LatLng(latitude, longitude),
        zoom: 13,
        scrollwheel: false,
        navigationControl: false,
        mapTypeControl: false,
        zoomControl: true,
        disableDefaultUI: true, 
        mapTypeId: 'Styled'
    };
    var div = document.getElementById('contact-map');
    var map = new google.maps.Map(div, options);
    marker = new google.maps.Marker({
        map:map,
        draggable:false,
        animation: google.maps.Animation.DROP,
        position: new google.maps.LatLng(latitude,longitude)
    });
    var styledMapType = new google.maps.StyledMapType(styles, { name: 'Styled' });
    map.mapTypes.set('Styled', styledMapType);
    
    var infowindow = new google.maps.InfoWindow({
          content: "<div class='iwContent'>"+address+"</div>"
    });
    google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map,marker);
      });
    
    
    bounds = new google.maps.LatLngBounds(
      new google.maps.LatLng(-84.999999, -179.999999), 
      new google.maps.LatLng(84.999999, 179.999999));

    rect = new google.maps.Rectangle({
        bounds: bounds,
        fillColor: color,
        fillOpacity: 0.2,
        strokeWeight: 0,
        map: map
    });
}
google.maps.event.addDomListener(window, 'load', getGeocode);
</script>