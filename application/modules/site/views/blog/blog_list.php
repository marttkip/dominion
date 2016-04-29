<?php

		$result = '';
		
		//if users exist display them
	
		if ($query->num_rows() > 0)
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
			$counter = 0;
			foreach ($query->result() as $row)
			{
				$counter++;
				$post_id = $row->post_id;
				$blog_category_name = $row->blog_category_name;
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
				$mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 50));
				$created = $row->created;
				$day = date('j',strtotime($created));
				$month = date('M Y',strtotime($created));
				$created_on = date('jS M Y H:i a',strtotime($row->created));
				
				$categories = '';
				$count = 0;
				//get all administrators
					$administrators = $this->users_model->get_all_administrators();
					if ($administrators->num_rows() > 0)
					{
						$admins = $administrators->result();
						
						if($admins != NULL)
						{
							foreach($admins as $adm)
							{
								$user_id = $adm->user_id;
								
								if($user_id == $created_by)
								{
									$created_by = $adm->first_name;
								}
							}
						}
					}
					
					else
					{
						$admins = NULL;
					}
				
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
					$last = '';
					if(($counter%2) == 0)
					{
						$last = 'last';
					}

				$result .= '
						
	                    <article class="post-list-item format-standard">
                        	<div class="post-media">
                           		<a href="'.site_url().'blog/'.$web_name.'" class="media-box"><img src="'.$image.'" alt="" class="post-thumb"></a>
                            </div>
                            <div class="post-excerpt">
                           		<span class="meta-data"><i class="fa fa-calendar"></i> '.$created_on.' by <a href="blog-standard.html#">imithemes</a></span>
                            	<h3 class="post-title"><a href="'.site_url().'blog/'.$web_name.'">'.$post_title.'</a></h3>
                          		<p>'.$mini_desc.'</p>
                                <span class="meta-data post-cats"><a href="'.site_url().'blog/'.$web_name.'"><a href="'.site_url().'blog/'.$web_name.'#comments">'.$total_comments.' <i class="fa fa-comments"></i></a></span>
                           		<a href="'.site_url().'blog/'.$web_name.'" class="basic-link">Continue reading</a>
                            </div>
                        </article>
		          
		            ';
		        }
			}
			else
			{
				$result .= "There are no posts :-(";
			}
           
          ?>          
<!-- Start Page Header -->
<div class="page-header parallax clearfix" style="background-color:#333">
	<div class="page-header-overlay" style="background-image:url(images/ph4.jpg);"></div>
    <div class="title-subtitle-holder">
    	<div class="title-subtitle-holder-inner">
			<h2>Blog</h2>
            <hr class="sm">
            <span class="subtitle">What we have in store for everyone</span>
        </div>
    </div>
</div>
<!-- End Page Header -->
 <!-- Breadcrumbs -->
<div class="lgray-bg breadcrumb-cont">
	<div class="container">
      	<ol class="breadcrumb">
        	<li><a href="<?php echo site_url();?>home">Home</a></li>
        	<li class="active">Blog</li>
      	</ol>
    </div>
</div>
<!-- Start Body Content -->

<!-- Start Body Content -->
<div class="main" role="main">
	<div id="content" class="content full">
		<div class="container">
	        <div class="row">
	        	<div class="col-md-8">
	                <div class="posts-listing">
	                   <?php echo $result;?>
	                </div>
	                <!-- Pagination -->
	              <!--   <ul class="pagination">
	                    <li><a href="blog-standard.html#"><i class="fa fa-chevron-left"></i></a></li>
	                    <li><a href="blog-standard.html#">1</a></li>
	                    <li class="active"><a href="blog-standard.html#">2</a></li>
	                    <li><a href="blog-standard.html#">3</a></li>
	                    <li><a href="blog-standard.html#">4</a></li>
	                    <li><a href="blog-standard.html#">5</a></li>
	                    <li><a href="blog-standard.html#"><i class="fa fa-chevron-right"></i></a></li>
	                </ul> -->
	            </div>
	            <div class="col-md-4">
	            	<?php echo $this->load->view('blog/includes/sidebar', '', TRUE);?>
	            </div>
	        </div>
	 	</div>
	</div>
</div>
<!-- End Body Content -->

