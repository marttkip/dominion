<?php
$news_item_post ='';
$upcoming = '';

if ($events->num_rows() > 0)
{
	$result = $events->result();
	
	$upcoming = '
	<a href="'.site_url().'events/'.$this->site_model->create_web_name($result[0]->post_title).'" class="media-box">
		<img src="'.base_url().'assets/images/posts/'.$result[0]->post_image.'" alt="'.$result[0]->post_title.'">
	</a>
	<div class="upcoming-event-content">
		<span class="label label-primary upcoming-event-label">Next coming event</span>
		<div id="counter" class="counter clearfix" data-date="July 13, 2015">
			<div class="timer-col"> <span id="days"></span> <span class="timer-type">Days</span> </div>
			<div class="timer-col"> <span id="hours"></span> <span class="timer-type">Hours</span> </div>
			<div class="timer-col"> <span id="minutes"></span> <span class="timer-type">Minutes</span> </div>
			<div class="timer-col"> <span id="seconds"></span> <span class="timer-type">Seconds</span> </div>
		</div>
		<h3><a href="single-event.html" class="event-title">'.$result[0]->post_title.'</a></h3>
		<span class="meta-data">On <span class="event-date">'.date('jS M, y',strtotime($result[0]->created)).'</span>  <span class="event-time"></span> </span>
		<!--<span class="meta-data event-location"> <span class="event-location-address">State Route, Madison US</span></span>-->
	</div>
	<div class="upcoming-event-footer">
		<a href="'.site_url().'events/'.$this->site_model->create_web_name($result[0]->post_title).'" class="pull-right btn btn-primary btn-sm event-tickets event-register-button">View</a>
		<ul class="action-buttons">
			<li title="Share event"><a href="#" data-trigger="focus" data-placement="top" data-content="" data-toggle="popover" data-original-title="Share Event" class="event-share-link"><i class="icon-share"></i></a></li>
			<li title="Get directions" class="hidden-xs"><a href="#" class="cover-overlay-trigger event-direction-link"><i class="icon-compass"></i></a></li>
			<li title="Contact event manager"><a href="#" data-toggle="modal" data-target="#Econtact" class="event-contact-link"><i class="icon-mail"></i></a></li>
		</ul>
	</div>
	
	';
	foreach ($events->result() as $news_items_row)
	{
		$id = $news_items_row->post_id;
		$title = $news_items_row->post_title;
		$web_name = $this->site_model->create_web_name($title);
		$post_content = $news_items_row->post_content;
		$date = date('jS M Y',strtotime($news_items_row->created));
		$day = date('j',strtotime($news_items_row->created));
		$month = date('M y',strtotime($news_items_row->created));
		$post_image = $news_items_row->post_image;
		$mini_string = (strlen($post_content) > 15) ? substr($post_content,0,50).'...' : $post_content;
		$mini_title = (strlen($title) > 15) ? substr($title,0,50).'...' : $title;
		$news_item_post .='
			<div class="event-list-item event-dynamic">
				<div class="event-list-item-date">
					<span class="event-date">
						<span class="event-day">'.$day.'</span>
						<span class="event-month">'.$month.'</span>
					</span>
				</div>
				<div class="event-list-item-info">
					<div class="lined-info">
						<h4><a href="'.site_url().'events/'.$web_name.'" class="event-title">'.$title.'</a></h4>
					</div>
					<!--<div class="lined-info">
						<span class="meta-data"><i class="fa fa-clock-o"></i> Monday, <span class="event-time">10:00 AM</span></span>
					</div>
					<div class="lined-info event-location">
						<span class="meta-data"><i class="fa fa-map-marker"></i> <span class="event-location-address">State Route, Madison US</span></span>
					</div>-->
				</div>
				<div class="event-list-item-actions">
					<ul class="action-buttons">
						<a href="'.site_url().'events/'.$web_name.'" class="btn btn-default btn-transparent event-tickets event-register-button">View</a>
						<li title="Share event"><a href="#" data-trigger="focus" data-placement="top" data-content="" data-toggle="popover" data-original-title="Share Event" class="event-share-link"><i class="icon-share"></i></a></li>
						<li title="Get directions" class="hidden-xs"><a href="#" class="cover-overlay-trigger event-direction-link"><i class="icon-compass"></i></a></li>
						<li title="Contact event manager"><a href="#" data-toggle="modal" data-target="#Econtact" class="event-contact-link"><i class="icon-mail"></i></a></li>
					</ul>
				</div>
			</div>';
	}
}
?>
				<div class="row">
                    <div class="col-md-4 col-sm-5">
                        <section class="upcoming-event format-standard event-list-item event-dynamic">
                            <?php echo $upcoming;?>
                        </section>
                   	</div>
                    <div class="col-md-8 col-sm-7">
                        <div class="element-block events-listing">
                            <div class="events-listing-header">
                                <a href="<?php echo site_url().'events';?>" class="pull-right basic-link">All Events</a>
                                <h3 class="element-title">Upcoming Events</h3>
                                <hr class="sm">
                            </div>
                            <div class="events-listing-content">
                                <?php echo $news_item_post;?>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="fw">
                