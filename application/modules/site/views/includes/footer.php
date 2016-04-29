<?php

$company_details = $this->site_model->get_contacts();

$popular_query = $this->blog_model->get_popular_posts();

if($popular_query->num_rows() > 0)
{
	$popular_posts = '';
	$count = 0;
	foreach ($popular_query->result() as $row)
	{
		$count++;
		
		if($count < 3)
		{
			$post_id = $row->post_id;
			$post_title = $row->post_title;
			$image = base_url().'assets/images/posts/thumbnail_'.$row->post_image;
			$comments = $this->users_model->count_items('post_comment', 'post_id = '.$post_id);
			$description = $row->post_content;
			$mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 10));
			$created = date('jS M Y',strtotime($row->created));
			
			$popular_posts .= '
				<li>
					<div style="background-image:url('.$image.');" class="pm-recent-blog-post-thumb"></div>
					<div class="pm-recent-blog-post-details">
						<a href="'.site_url().'blog/view-single/'.$post_id.'">'.$mini_desc.'</a>
						<p class="pm-date">'.$created.'</p>
						<div class="pm-recent-blog-post-divider"></div>
					</div>
				</li>
			';
		}
	}
}

else
{
	$popular_posts = 'There are no posts yet';
}
?>

 <footer class="site-footer">
        <div class="container">
            <div class="site-footer-top">
                <div class="row">
                    <div class="col-md-4 widget footer_widget text_widget">
                        <h4>About our Dominion Generation</h4>
                        <hr class="sm">
                        <p>Dominion Generation is an empowerment engagement with juniors, young professions and also the seniors to help them build their statuses in life through practical lessons that the foundations engages in.</p>
                    </div>
                    <div class="col-md-4 widget footer_widget twitter_widget">
                        <h4>Our Location</h4>
                        <hr class="sm">
                         <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.827930758751!2d36.81798031432537!3d-1.2766536359747769!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f172bf2fc9c5b%3A0x9c1b2815f7c0853a!2sUzuri+Institute+of+Technology+and+Development!5e0!3m2!1sen!2ske!4v1455261085905"  frameborder="0" style="border:0" allowfullscreen></iframe>

                        <!-- <ul class="twitter-widget"></ul> -->
                    </div>
                    <div class="col-md-4 widget footer_widget newsletter_widget">
                        <h4>News subscription</h4>
                        <hr class="sm">
                        <p>Subscribe to our newsletter in order to receive the latest new &amp; articles. We promise we won't spam your inbox!</p>
                        <div class="input-group">
                            <span class="input-group-addon">@</span>
                            <input type="text" class="form-control">
                            <span class="input-group-btn">
                            <button class="btn btn-primary" type="button">Go!</button>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- Quick Info -->
                <div class="quick-info">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <h4><i class="fa fa-clock-o"></i> Service Times</h4>
                            <p>Sundays @ 10:00 am<br>Starting October 1</p>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <h4><i class="fa fa-map-marker"></i> Our Location</h4>
                            <p>Haile selasse Road , <br>Opp Thika School for the blind, <br> P.O Box 2201 Thika 01000</p>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <h4><i class="fa fa-envelope"></i> Contact Info</h4>
                            <p>0723 560 867 / 0700 455 435<br>info@dominiongeneration.org</p>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <h4><i class="fa fa-clock-o"></i> Socialize with us</h4>
                            <ul class="social-icons-colored inversed">
                                <li class="facebook"><a href="http://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
                                <li class="twitter"><a href="http://twitter.com/"><i class="fa fa-twitter"></i></a></li>
                                <li class="googleplus"><a href="http://plus.google.com/"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="site-footer-bottom">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 copyrights-coll">
                            &copy; 2016 Dominion Generation. All Rights Reserved
                        </div>
                        <div class="col-md-6 col-sm-6 copyrights-colr">
                            <nav class="footer-nav" role="navigation">
                                <ul>
                                    <li><a href="<?php echo site_url()?>home">Home</a></li>
                                    <li><a href="">New here?</a></li>
                                    <li><a href="<?php echo site_url();?>contact-us">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>