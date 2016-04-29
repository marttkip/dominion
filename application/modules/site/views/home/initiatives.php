<?php
$news_item_post ='';
$upcoming = '';
$sermons = '';

if ($initiatives->num_rows() > 0)
{
	$result = $events->result();
	
	$upcoming = '
	<a href="" class="media-box post-thumb">
		<img src="'.base_url().'assets/images/posts/'.$result[0]->post_image.'" alt="'.$result[0]->post_title.'">
	</a>
	<h3 class="post-title"><a href="'.site_url().'events/'.$this->site_model->create_web_name($result[0]->post_title).'">'.$result[0]->post_title.'</a></h3>
	<p>'.implode(' ', array_slice(explode(' ', $result[0]->post_content), 0, 50)).'</p>
	<p><a href="'.site_url().'events/'.$this->site_model->create_web_name($result[0]->post_title).'" class="basic-link">Continue reading</a></p>		
	
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
			<li>
				<a href=""><strong class="post-title">'.$title.'</strong></a>
				<p>'.$mini_string.'</p>
				<p><a href="'.site_url().'events/'.$web_name.'" class="basic-link">Continue reading</a></p>
			</li>';
	}
}

if ($latest_sermons->num_rows() > 0)
{
	$result = $latest_sermons->result();
	$post_audio = $result[0]->post_audio;
	$post_video = $result[0]->post_video;
	$post_title = $result[0]->post_title;
	$post_content = $result[0]->post_content;
	$web_name = $this->site_model->create_web_name($post_title);
	$mini_string = (strlen($post_content) > 15) ? substr($post_content,0,50).'...' : $post_content;
	
	$sermons = '
	<li class="most-recent-sermon clearfix">
		<h3 class="purple-text">Latest Sermons</h3>
		<hr class="sm">';
		
	if(!empty($post_audio))
	{
		$sermons .= '
			<div class="latest-sermon-video fw-video">
				Audio
				<audio controls>
					<source src="'.base_url().'assets/img/posts/'.$post_audio.'" type="audio/mpeg" class="align-centre">
					Your browser does not support the audio element.
				</audio>
			</div>
			';
		}
		if(!empty($post_video))
		{
			$sermons .= '
			<div class="latest-sermon-video fw-video">
				<iframe src="https://player.vimeo.com/video/37540860?title=0&amp;byline=0&amp;portrait=0" width="500" height="281"></iframe>
			</div>
		';
	}
	
	$sermons .= '
		<div class="latest-sermon-content">
			<h4><a href="'.site_url().'events/'.$web_name.'">'.$post_title.'</a></h4>
			<p>'.$mini_string.'</p>
		</div>
	</li>
	';
	
	$count = 0;
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
		$count++;
		
		if($count > 1)
		{
			$sermons .='
				<li>
					<a href="'.site_url().'events/'.$web_name.'"><strong class="post-title">'.$title.'</strong></a>
				</li>';
		}
	}
}
?>
			<div class="row">
                    <div class="col-md-8">
                        <h3 class="purple-text">Latest Initiative</h3>
                        <hr class="sm">
                        <div class="row">
                        	<div class="col-md-6">
                            	<div class="very-latest-post format-standard">
                                	<div class="title-row">
                                		<a href="#comments" class="comments-go" title="10 comments"><i class="icon-dialogue-text"></i></a>
                                		<h4 class="purple-text">Very latest</h4>
                                    </div>
                                    <?php echo $upcoming;?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <ul class="blog-classic-listing">
                                    <?php echo $news_item_post;?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                    	<div class="widget latest_sermons_widget">
                        	<ul>
                            	<?php echo $sermons;?>
                           	</ul>
                        </div>
                    </div>
                </div>
            