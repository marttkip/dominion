<?php

	$result = '';
	
	//if users exist display them

	if ($latest_posts->num_rows() > 0)
	{	
		//get all administrators
		$administrators = $this->users_model->get_all_administrators();
		if ($administrators->num_rows() > 0)
		{
			$admins = $administrators->result();
		}
		
		else
		{
			$admins = NULL;
		}
		
		foreach ($latest_posts->result() as $row)
		{
			$post_id = $row->post_id;
			$blog_category_name = $row->blog_category_name;
			$blog_category_web_name = $this->site_model->create_web_name($blog_category_name);
			$blog_category_id = $row->blog_category_id;
			$post_title = $row->post_title;
			$web_name = $this->site_model->create_web_name($post_title);
			$post_status = $row->post_status;
			$post_views = $row->post_views;
			$image = base_url().'assets/images/posts/'.$row->post_image;
			$created_by = $row->created_by;
			$modified_by = $row->modified_by;
			$comments = $this->users_model->count_items('post_comment', 'post_id = '.$post_id);
			$categories_query = $this->blog_model->get_all_post_categories($blog_category_id);
			$description = $row->post_content;
			$mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 30));
			$created = $row->created;
			$day = date('j',strtotime($created));
			$month = date('M Y',strtotime($created));
			$created_on = date('jS M Y',strtotime($row->created));
			
			$categories = '';
			$count = 0;
			
				foreach($categories_query->result() as $res)
				{
					$count++;
					$category_name = $res->blog_category_name;
					$category_id = $res->blog_category_id;
					
					if($count == $categories_query->num_rows())
					{
						$categories .= '<a href="'.site_url().'blog/category/'.$category_id.'" title="View all posts in '.$category_name.'" rel="category tag">'.$category_name.'</a>';
					}
					
					else
					{
						$categories .= '<a href="'.site_url().'blog/category/'.$category_id.'" title="View all posts in '.$category_name.'" rel="category tag">'.$category_name.'</a>, ';
					}
				}
				$comments_query = $this->blog_model->get_post_comments($post_id);
				//comments
				$comments = 'No Comments';
				$total_comments = $comments_query->num_rows();
				if($total_comments == 1)
				{
					$title = 'comment';
				}
				else
				{
					$title = 'comments';
				}
				
				if($comments_query->num_rows() > 0)
				{
					$comments = '';
					foreach ($comments_query->result() as $row)
					{
						$post_comment_user = $row->post_comment_user;
						$post_comment_description = $row->post_comment_description;
						$date = date('jS M Y H:i a',strtotime($row->comment_created));
						
						$comments .= 
						'
							<div class="user_comment">
								<h5>'.$post_comment_user.' - '.$date.'</h5>
								<p>'.$post_comment_description.'</p>
							</div>
						';
					}
				}
			$result .= '
			 
			    <li>
                    <a href="'.site_url().'blog/'.$web_name.'"><strong class="post-title">'.$post_title.'</strong></a>
                    <div class="meta-data">by <a href="index.html#">imithemes</a> on '.$created_on.' in <a href="index.html#">General</a></div>
                    <p>'.$mini_desc.'...</p>
                    <p><a href="'.site_url().'blog/'.$web_name.'" class="basic-link">Continue reading</a></p>
                </li>

				';
			}
		}
		else
		{
			$result = "There are no posts :-(";
		}

		//if users exist display them
		$other = '';
	if ($latest_post->num_rows() > 0)
	{	
		//get all administrators
		$administrators = $this->users_model->get_all_administrators();
		if ($administrators->num_rows() > 0)
		{
			$admins = $administrators->result();
		}
		
		else
		{
			$admins = NULL;
		}
		
		foreach ($latest_post->result() as $latest_row)
		{
			$post_id = $latest_row->post_id;
			$blog_category_name = $latest_row->blog_category_name;
			$blog_category_web_name = $this->site_model->create_web_name($blog_category_name);
			$blog_category_id = $latest_row->blog_category_id;
			$post_title = $latest_row->post_title;
			$web_name = $this->site_model->create_web_name($post_title);
			$post_status = $latest_row->post_status;
			$post_views = $latest_row->post_views;
			$image = base_url().'assets/images/posts/'.$latest_row->post_image;
			$created_by = $latest_row->created_by;
			$modified_by = $latest_row->modified_by;
			$comments = $this->users_model->count_items('post_comment', 'post_id = '.$post_id);
			$categories_query = $this->blog_model->get_all_post_categories($blog_category_id);
			$description = $latest_row->post_content;
			$mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 30));
			$created = $latest_row->created;
			$day = date('j',strtotime($created));
			$month = date('M Y',strtotime($created));
			$created_on = date('jS M Y',strtotime($latest_row->created));
			
			$categories = '';
			$count = 0;
			
				foreach($categories_query->result() as $res)
				{
					$count++;
					$category_name = $res->blog_category_name;
					$category_id = $res->blog_category_id;
					
					if($count == $categories_query->num_rows())
					{
						$categories .= '<a href="'.site_url().'blog/category/'.$category_id.'" title="View all posts in '.$category_name.'" rel="category tag">'.$category_name.'</a>';
					}
					
					else
					{
						$categories .= '<a href="'.site_url().'blog/category/'.$category_id.'" title="View all posts in '.$category_name.'" rel="category tag">'.$category_name.'</a>, ';
					}
				}
				$comments_query = $this->blog_model->get_post_comments($post_id);
				//comments
				$comments = 'No Comments';
				$total_comments = $comments_query->num_rows();
				if($total_comments == 1)
				{
					$title = 'comment';
				}
				else
				{
					$title = 'comments';
				}
				
				if($comments_query->num_rows() > 0)
				{
					$comments = '';
					foreach ($comments_query->result() as $row)
					{
						$post_comment_user = $row->post_comment_user;
						$post_comment_description = $row->post_comment_description;
						$date = date('jS M Y H:i a',strtotime($row->comment_created));
						
						$comments .= 
						'
							<div class="user_comment">
								<h5>'.$post_comment_user.' - '.$date.'</h5>
								<p>'.$post_comment_description.'</p>
							</div>
						';
					}
				}
			
			}
			$other = ' <div class="very-latest-post format-standard">
                                    <div class="title-row">
                                        <a href="blog-post.html#comments" class="comments-go" title="10 comments"><i class="icon-dialogue-text"></i></a>
                                        <h4>Very latest</h4>
                                    </div>
                                    <a href="blog-post.html" class="media-box post-thumb">
                                        <img src="'.$image.'" alt="">
                                    </a>
                                    <h3 class="post-title"><a href="'.site_url().'blog/'.$web_name.'">'.$post_title.'</a></h3>
                                    <div class="meta-data">by <a href="'.site_url().'blog/'.$web_name.'">imithemes</a> on '.$created_on.' in <a href="index.html#">General</a></div>
                                    <p>'.$mini_desc.'...</p>
                                    <p><a href="'.site_url().'blog/'.$web_name.'" class="basic-link">Continue reading</a></p>
                                </div>';
		}
		else
		{
			$other = "There are no posts :-(";
		}
	   
	  ?>
<div class="row">
                    <div class="col-md-8">
                        <h3>From our blog</h3>
                        <hr class="sm">
                        <div class="row">
                            <div class="col-md-6">
                               <?php echo $other;?>
                            </div>
                            <div class="col-md-6">
                                <ul class="blog-classic-listing">
                                    <?php echo $result;?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="widget latest_sermons_widget">
                            <ul>
                                <li class="most-recent-sermon clearfix">
                                    <h3>Recent Sermons</h3>
                                    <hr class="sm">
                                    <div class="latest-sermon-video fw-video">
                                        <iframe src="https://player.vimeo.com/video/37540860?title=0&amp;byline=0&amp;portrait=0" width="500" height="281"></iframe>
                                    </div>
                                    <div class="latest-sermon-content">
                                        <h4><a href="#">Rushing wind</a></h4>
                                        <div class="meta-data">by <a href="index.html#">Chris Hodges</a></div>
                                        <p>Nulla consequat massa quis enim, aliquet nec nulla consequat massa quis enim, vulputate eget...</p>
                                    </div>
                                    <div class="sermon-links">
                                        <ul class="action-buttons">
                                            <li><a href="single-sermon.html" data-toggle="tooltip" data-placement="right" data-original-title="Watch Video"><i class="icon-video-cam"></i></a></li>
                                            <li><a href="single-sermon.html" data-toggle="tooltip" data-placement="right" data-original-title="Listen Audio"><i class="icon-headphones"></i></a></li>
                                            <li><a href="single-sermon.html" data-toggle="tooltip" data-placement="right" data-original-title="Download Audio"><i class="icon-cloud-download"></i></a></li>
                                            <li><a href="single-sermon.html" data-toggle="tooltip" data-placement="right" data-original-title="Download PDF"><i class="icon-download-folder"></i></a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="#"><strong class="post-title">Worship God’s Way</strong></a>
                                        <div class="meta-data">by <a href="index.html#">Dino Rizzo</a></div>
                                </li>
                                <li>
                                    <a href="#"><strong class="post-title">What God Really Wants</strong></a>
                                        <div class="meta-data">by <a href="index.html#">Chris Hodges</a></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>