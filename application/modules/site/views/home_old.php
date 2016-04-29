<div class="body"> 
    <?php echo $this->load->view('includes/navigation', '', TRUE);?>
    <!-- Start Hero Slider -->
    <div class="hero-slider heroflex flexslider clearfix" data-autoplay="yes" data-pagination="no" data-arrows="yes" data-style="fade" data-speed="7000" data-pause="yes">
        <ul class="slides">
            <li class="parallax" style="background-image:url(<?php echo site_url();?>assets/themes/adore/images/slide3.jpg);">
                <div class="flex-caption" data-appear-animation="fadeInRight" data-appear-animation-delay="500">
                    <strong>God is the word</strong>
                    <p>Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p>
                </div>
            </li>
            <li class="parallax" style="background-image:url(<?php echo site_url();?>assets/themes/adore/images/slide8.jpg);">
                <div class="flex-caption" data-appear-animation="fadeInRight" data-appear-animation-delay="500">
                    <strong>Find your way back home</strong>
                    <p>Lorem ipsum dolor sit met, conteturing elit. Phasellus pellentesque osure risus lacinia tristique Fusce sed massa</p>
                </div>
            </li>
        </ul>
        <canvas id="canvas-animation"></canvas>
    </div>
    <!-- End Hero Slider -->
    <!-- Lead Content -->
    <div class="lead-content clearfix">
        <div class="lead-content-wrapper">
                <div class="header-title">
                     <h2 style="margin:0 auto;">-- JOIN A GROUP --</h2>
                </div>
               
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4 featured-block">
                        <h3>DG JUNIOR</h3>
                        <figure>
                            <a href="#"><img src="<?php echo site_url();?>assets/images/junior.jpeg" alt="Our Community"></a>
                        </figure>
                        <p>DG Juniors seeks to empower primary school children with life skills that helps them to grow in the light of being independent people and also having a vision in life </p>
                    </div>
                  
                    <div class="col-md-4 col-sm-4 featured-block">
                        <h3>DG SENIORS</h3>
                        <figure>
                            <a href="#"><img src="<?php echo site_url();?>assets/themes/adore/images/img_join.jpg" alt="Our Community"></a>
                        </figure>
                        <p>DG Seniors seeks to empower secondary school student through mentorship programs in identifying a purpose in life and also looking out to growth in terms of ideas to make better adults in life .</p>
                    </div>
                      <div class="col-md-4 col-sm-4 featured-block">
                        <h3>DG YOUNG PROFESSIONALS</h3>
                        <figure>
                            <a href="#"><img src="<?php echo site_url();?>assets/images/young.jpg" alt="Our Community"></a>
                        </figure>
                        <p>DG Young Profesionals seeks to empower college and university student build up carrers that can help them in life and also understanding the needs in business industries around.  </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Body Content -->
    <?php echo $this->load->view('includes/main', '', TRUE);?>
 
    <!-- End Body Content -->
    <!-- Gallery updates -->
    <div class="gallery-updates cols5 clearfix">
        <ul>
          <?php
            // get gallery items 
            if($gallery->num_rows() > 0)
            {
                foreach($gallery->result() as $res)
                {
                    $gallery_name = $res->gallery_name;
                    $gallery_image_name = $res->gallery_image_name;
                    $service_name = '';
                    ?>
                    <li class="format-image"><a href="<?php echo $gallery_location.$gallery_image_name;?>" data-rel="prettyPhoto" class="media-box"><img src="<?php echo $gallery_location.$gallery_image_name;?>" alt=""></a></li>
            
                    <?php
                }
            }
            ?>
        </ul>
        <div class="gallery-updates-overlay">
            <div class="container">
                <i class="icon-multiple-image"></i>
                <h2>Updates from our gallery</h2>
            </div>
        </div>
    </div>

    <!-- Start site footer -->
    <?php echo $this->load->view('includes/footer', '', TRUE);?>
    
    <!-- End site footer -->
    <a id="back-to-top"><i class="fa fa-angle-double-up"></i></a>  
</div>

<!-- Event Directions Popup -->
<div class="quick-info-overlay">
    <div class="quick-info-overlay-left accent-bg">
        <a href="index.html#" class="btn-close"><i class="icon-delete"></i></a>
        <div class="event-info">
            <h3 class="event-title"> </h3>
            <div class="event-address"></div>
            <a href="index.html" class="btn btn-default btn-transparent btn-permalink">Full details</a>
        </div>
    </div>
    <div class="quick-info-overlay-right">
        <div id="event-directions"></div>
    </div>
</div>
<!-- Event Contact Modal Window -->
<div class="modal fade" id="Econtact" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="Econtact" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Contact Event Manager <span class="accent-color"></span></h4>
      </div>
      <div class="modal-body">
        <form>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="fname" class="form-control" placeholder="First name (Required)">
                </div>
                <div class="col-md-6">
                    <input type="text" name="lname" class="form-control" placeholder="Last name">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <input type="email" name="email" class="form-control" placeholder="Your email (Required)">
                </div>
                <div class="col-md-6">
                    <input type="number" name="phone" class="form-control" placeholder="Your phone">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <textarea rows="3" cols="5" class="form-control" placeholder="Additional notes"></textarea>
                </div>
            </div>
            <input type="submit" name="donate" class="btn btn-primary btn-lg btn-block" value="Contact Now">
        </form>
      </div>
      <div class="modal-footer">
        <p class="small short">If you would prefer to call in for inquiries, please call 1800.785.876</p>
      </div>
    </div>
  </div>
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