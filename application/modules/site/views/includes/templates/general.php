<!DOCTYPE html>
<html class="no-js">
	<?php echo $this->load->view('includes/header', '', TRUE);?>
	
    <body class="home">
    	<!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->
        
        <div class="body">
			<?php echo $this->load->view('includes/navigation', '', TRUE);?>
            <?php echo $content; ?>
            <?php echo $this->load->view('includes/footer', '', TRUE);?>
        </div>
        
        <!-- Event Register Tickets -->
        <div class="ticket-booking-wrapper">
            <a href="index.html#" class="ticket-booking-close label-danger"><i class="icon icon-delete"></i></a>
            <div class="ticket-booking">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <h3><strong>Book your</strong> <span>tickets</span></h3>
                        </div>
                        <div class="col-md-9">
                            <div class="event-ticket ticket-form">
                                <div class="event-ticket-left">
                                    <div class="ticket-handle"></div>
                                    <div class="ticket-cuts ticket-cuts-top"></div>
                                    <div class="ticket-cuts ticket-cuts-bottom"></div>
                                </div>
                                <div class="event-ticket-right">
                                    <div class="event-ticket-right-inner">
                                        <div class="row">
                                            <div class="col-md-9 col-sm-9">
                                                <span class="meta-data">Your ticket for</span>
                                                <h4 id="dy-event-title"></h4>
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <span class="meta-data">Tickets count</span>
                                                <select class="form-control input-sm">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="event-ticket-info">
                                            <div class="row">
                                                <div class="col">
                                                    <p class="ticket-col" id="dy-event-date"></p>
                                                </div>
                                                <div class="col">
                                                    <a href="index.html#" class="btn btn-warning btn btn-block ticket-col">Book</a>
                                                </div>
                                                <div class="col">
                                                    <p id="dy-event-time">Starts </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="event-location" id="dy-event-location"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="<?php echo site_url()?>assets/themes/adore/js/jquery-2.0.0.min.js"></script> <!-- Jquery Library Call -->
		<script src="<?php echo site_url()?>assets/themes/adore/vendor/prettyphoto/js/prettyphoto.js"></script> <!-- PrettyPhoto Plugin -->
        <script src="<?php echo site_url()?>assets/themes/adore/js/helper-plugins.js"></script> <!-- Helper Plugins -->
        <script src="<?php echo site_url()?>assets/themes/adore/js/bootstrap.js"></script> <!-- UI -->
        <script src="<?php echo site_url()?>assets/themes/adore/js/init.js"></script> <!-- All Scripts -->
        <script src="<?php echo site_url()?>assets/themes/adore/js/home.js"></script> <!-- All Scripts -->
        <script src="<?php echo site_url()?>assets/themes/adore/vendor/flexslider/js/jquery.flexslider.js"></script> <!-- FlexSlider -->
        <script src="<?php echo site_url()?>assets/themes/adore/vendor/countdown/js/jquery.countdown.min.js"></script> <!-- Jquery Timer -->
        <script src="<?php echo site_url()?>assets/themes/adore/vendor/mediaelement/mediaelement-and-player.min.js"></script> <!-- MediaElements 
        <script src="//maps.googleapis.com/maps/api/js?sensor=false"></script>--> 
	</body>
</html>