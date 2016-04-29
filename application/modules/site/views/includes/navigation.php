<?php
	$contacts = $this->site_model->get_contacts();
	
	if(count($contacts) > 0)
	{
		$email = $contacts['email'];
		$email2 = $contacts['email'];
		$facebook = $contacts['facebook'];
		$twitter = $contacts['twitter'];
		$linkedin = $contacts['linkedin'];
		$logo = $contacts['logo'];
		$company_name = $contacts['company_name'];
		$phone = $contacts['phone'];
		
		if(!empty($email))
		{
			$email = '<div class="top-number"><p><i class="fa fa-envelope-o"></i> '.$email.'</p></div>';
		}
		
		if(!empty($facebook))
		{
			$twitter = '<li class="pm_tip_static_bottom" title="Twitter"><a href="#" class="fa fa-twitter" target="_blank"></a></li>';
		}
		
		if(!empty($facebook))
		{
			$linkedin = '<li class="pm_tip_static_bottom" title="Linkedin"><a href="#" class="fa fa-linkedin" target="_blank"></a></li>';
		}
		
		if(!empty($facebook))
		{
			$google = '<li class="pm_tip_static_bottom" title="Google Plus"><a href="#" class="fa fa-google-plus" target="_blank"></a></li>';
		}
		
		if(!empty($facebook))
		{
			$facebook = '<li class="pm_tip_static_bottom" title="Facebook"><a href="#" class="fa fa-facebook" target="_blank"></a></li>';
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
		$google = '';
	}
?>
 <!-- Start Site Header -->
    <header class="site-header">
        <div class="container for-navi">
            <div class="site-logo">
            <h1>
                <a href="index.html">
                    <span class="logo-icon">
                    	<img src="<?php echo base_url().'assets/logo/'.$logo;?>" class="img-responsive" />
                    </span>
                    <span class="logo-text">Dominion <span>Generation</span></span>
                    <span class="logo-tagline"></span>
                </a>
            </h1>
            </div>
            <!-- Main Navigation -->
            <nav class="main-navigation" role="navigation">
             <ul class="sf-menu">
                <!-- 
                    <li><a href="javascript:void(0)">Home</a>
                        <ul class="dropdown">
                            <li><a href="index.html">Home Style 1</a></li>
                            <li><a href="index1.html">Home Style 2</a></li>
                            <li><a href="javascript:void(0)">Homepage Sliders</a>
                                <ul class="dropdown">
                                    <li><a href="index.html">FlexSlider</a></li>
                                    <li><a href="index-nivoslider.html">NivoSlider</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)">Header Styles</a>
                                <ul class="dropdown">
                                    <li><a href="index.html">Style 1</a></li>
                                    <li><a href="header-style2.html">Style 2</a></li>
                                    <li><a href="header-style3.html">Style 3</a></li>
                                    <li><a href="header-style4.html">Style 4</a></li>
                                    <li><a href="header-style5.html">Style 5</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)">Footer Styles</a>
                                <ul class="dropdown">
                                    <li><a href="index.html">Light</a></li>
                                    <li><a href="footer-dark.html">Dark</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">About us</a>
                        <ul class="dropdown">
                            <li><a href="about.html">Overview</a></li>
                            <li><a href="new-here.html">New Here?</a></li>
                            <li><a href="staff.html">Our Staff</a></li>
                            <li><a href="donate.html">Donate now</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">Media</a>
                        <ul class="dropdown">
                            <li><a href="http://preview.imithemes.com/adore-church/sermons.html">Sermons</a>
                                <ul class="dropdown">
                                    <li><a href="sermons-series.html">Sermons Series</a></li>
                                    <li><a href="sermons-list.html">Sermons List</a></li>
                                    <li><a href="single-sermon.html">Single Sermon</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)">Gallery</a>
                                <ul class="dropdown">
                                    <li><a href="gallery-2cols-filter.html">With Filter</a>
                                        <ul class="dropdown">
                                            <li><a href="gallery-2cols-filter.html">2 Cols</a></li>
                                            <li><a href="gallery-3cols-filter.html">3 Cols</a></li>
                                            <li><a href="gallery-4cols-filter.html">4 Cols</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="gallery-2cols-pagination.html">With Pagination</a>
                                        <ul class="dropdown">
                                            <li><a href="gallery-2cols-pagination.html">2 Cols</a></li>
                                            <li><a href="gallery-3cols-pagination.html">3 Cols</a></li>
                                            <li><a href="gallery-4cols-pagination.html">4 Cols</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="gallery-galleria.html">Galleria Gallery</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">Events</a>
                        <ul class="dropdown">
                            <li><a href="events.html">Events List</a></li>
                            <li><a href="events-calendar.html">Events Calendar</a></li>
                            <li><a href="events-grid.html">Events Grid</a></li>
                            <li><a href="single-event.html">Single Event</a></li>
                        </ul>
                    </li>
                    <li class="megamenu"><a href="javascript:void(0)">Mega Menu</a>
                        <ul class="dropdown">
                            <li>
                                <div class="megamenu-container container">
                                    <div class="row">
                                        <div class="col-md-4 hidden-sm hidden-xs">
                                            <span class="megamenu-sub-title">Put videos</span>
                                            <div class="fw-video">
                                                <iframe src="https://player.vimeo.com/video/37540860?title=0&amp;byline=0&amp;portrait=0" width="500" height="281"></iframe>
                                            </div>
                                        </div>
                                        <div class="col-md-5"> <span class="megamenu-sub-title">Use for some content</span>
                                            <p>Nulla consequat massa quis enim.Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi.Aenean vulputate eleifend tellus.</p>
                                        </div>
                                        <div class="col-md-3"> <span class="megamenu-sub-title">Use Custom Menus</span>
                                            <ul class="sub-menu">
                                                <li><a href="about.html">About Us</a></li>
                                                <li><a href="404.html">404 Error</a></li>
                                                <li><a href="contact.html">Contact Us</a></li>
                                                <li><a href="typography.html">Typography</a></li>
                                                <li><a href="shortcodes.html">Shortcodes</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">Blog</a>
                        <ul class="dropdown">
                            <li><a href="blog-standard.html">Standard Blog</a></li>
                            <li><a href="blog-masonry.html">Masonry Blog</a></li>
                            <li><a href="blog-post.html">Single Post</a></li>
                        </ul>
                    </li>
                    <li><a href="contact.html">Contact</a></li> -->
                    <?php echo $this->site_model->get_navigation();?>
                </ul>
            </nav>       
            <a href="#" class="visible-sm visible-xs" id="menu-toggle"><i class="fa fa-bars"></i></a>
        </div>
    </header>
    <!-- End Site Header -->