<?php

$post_id = $row->post_id;
$blog_category_name = $row->blog_category_name;
$blog_category_id = $row->blog_category_id;
$post_title = $row->post_title;
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
             <li>
                    <div class="post-comment-block">
                        <!-- <div class="img-thumbnail"> <img src="images/img_avatar.png" alt="avatar"> </div> -->
                        <a href="" class=" pull-right" title="Reply to comment"><i class="fa fa-reply"></i></a>
                        <h5>'.$post_comment_user.' says</h5>
                        <span class="meta-data">'.$date.'</span>
                        <div class="comment-text">
                            <p>'.$post_comment_description.'.</p>
                        </div>
                    </div>
                </li>
				
			';
		}
	}
	



?>

 <!-- Start Page Header -->
    <div class="page-header parallax clearfix">
        <div class="title-subtitle-holder">
            <div class="title-subtitle-holder-inner">
                <h2><?php echo $post_title;?></h2>
            </div>
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Breadcrumbs -->
    <div class="lgray-bg breadcrumb-cont">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url()?>/home">Home</a></li>
                <li><a href="<?php echo site_url()?>/blog">Blogs</a></li>
                <li class="active"><?php echo $post_title;?></li>
            </ol>
        </div>
    </div>
    <!-- Start Body Content -->
    <div class="main" role="main">
        <div id="content" class="content full">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <article class="single-post format-standard">
                            <div class="title-row">
                                <a href="<?php echo site_url();?>/blog/<?php echo $post_title?>#comments" class="comments-go" title="<?php echo $total_comments;?> <?php echo $title;?>"><i class="icon-dialogue-text"></i></a>
                                <h2><?php  echo $post_title;?></h2>
                            </div>
                            <div class="meta-data">
                                <span><i class="fa fa-calendar"></i> <?php echo $created_on;?> by <a href="#">Admin</a></span>
                                <span><i class="fa fa-archive"></i> <a href=""><?php echo $category_name?></a></span>
                            </div>
                            <div class="post-media">
                                <a href="" class="media-box"><img src="<?php echo $image?>" alt="" class="post-thumb"></a>
                            </div>
                            <div class="post-content">
                                <p><?php echo $description?>.</p>
                            </div>
                            <div class="meta-data post-tags"><i class="fa fa-tags"></i> <a href="blog-post.html#">Baptism</a>, <a href="blog-post.html#">Featured</a></div>
                            <div class="social-share-bar">
                                <h4><i class="fa fa-share-alt"></i> Share</h4>
                                <ul class="social-icons-colored">
                                    <li class="facebook"><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
                                    <li class="twitter"><a href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>
                                    <li class="googleplus"><a href="https://plus.google.com/"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </article>
                        <!-- Post Comments -->
                        <section class="post-comments" id="comments">
                            <h4 class="title"><?php echo $title;?> (<?php echo $total_comments?>)</h4>
                            <ol class="comments">
                             <?php echo $comments;?>
                            </ol>
                        </section>
                        <section class="post-comment-form">
                            <h4 class="title">Post a comment</h4>
                            <form>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-4 col-sm-4">
                                            <input type="text" class="form-control" placeholder="Your name">
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <input type="email" class="form-control" placeholder="Your email">
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <input type="url" class="form-control" placeholder="Website (optional)">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <textarea cols="8" rows="4" class="form-control" placeholder="Your comment"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-lg">Submit your comment</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </section>
                    </div>
                    <div class="col-md-4">
                       
                       <?php echo $this->load->view('blog/includes/sidebar', '', TRUE);?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Body Content -->

