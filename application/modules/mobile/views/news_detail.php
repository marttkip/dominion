<?php
if ($query->num_rows() > 0)
{
	//comments
	$comments = '<li>No Comments</li>';
	if($comments_query->num_rows() > 0)
	{
		$comments = '';
		foreach ($comments_query->result() as $row)
		{
			$post_comment_user = $row->post_comment_user;
			$post_comment_description = $row->post_comment_description;
			$date = date('jS M, Y H:i a',strtotime($row->comment_created));
			
			$comments .= 
			'
				<li class="comment_row">
					<div class="comm_avatar"><img src="images/icons/black/user.png" alt="" title="" border="0" /></div>
					<div class="comm_content"><p>'.$post_comment_description.' by <a href="#">'.$post_comment_user.'</a></p></div>
				</li>
			';
		}
	}
	
	foreach ($query->result() as $row)
	{
		$id = $row->post_id;
		$title = $row->post_title;

		$image = base_url().'assets/img/posts/'.$row->post_image;
		$post_content = $row->post_content;
		$date = date('jS M Y',strtotime($row->created));
		$day = date('j',strtotime($row->created));
		$month = date('M',strtotime($row->created));
		$post_image = $row->post_image;
		$mini_string = (strlen($post_content) > 15) ? substr($post_content,0,50).'...' : $post_content;
		$mini_title = (strlen($title) > 15) ? substr($title,0,50).'...' : $title;
	}
	$result = '
		 <div class="post_single">
            <div class="featured_image">
              <img src="'.$image.'" alt="'.$title.'" title="'.$title.'" />
              <div class="post_title_single"><h2>'.$title.'</h2></div>
            </div>
                 
            <div class="page_content"> 
              <div class="entry">
              	'.$post_content.'
              </div>
            </div>
            
          </div>
          
          
          <div class="page_content"> 
          
          <div class="buttons-row">
                <a href="#tab1" class="tab-link active button">Leave a comment</a>
                <a href="#tab2" class="tab-link button">Comments</a>
          </div>
          
          <div class="tabs-animated-wrap">
                <div class="tabs">
                      <div id="tab1" class="tab active">
					  		<div id="comments_error"></div>
                            <div class="commentform">
                            <form id="CommentForm" method="post" action="">
							<input type="hidden" name="post_id" value="'.$id.'">
                            <label>Name:</label>
                            <input type="text" name="name" id="CommentName" value="" class="form_input" />
                            <label>Email:</label>
                            <input type="text" name="email" id="CommentEmail" value="" class="form_input" />
                            <label>Comment:</label>
                            <textarea name="comment" id="Comment" class="form_textarea" rows="" cols=""></textarea>
                            <input type="submit" name="submit" class="form_submit" id="submit" value="Submit" />
                            </form>
                            </div>
                      </div>

                      <div id="tab2" class="tab">
                            <ul class="comments" id="forum_comments">
                                '.$comments.'
                                <div class="clear"></div>
                            </ul>
                      </div> 
                </div>
          </div>
      
         </div>
                   
	 ';
}else
{
	$result = 'Post not found';
}
echo $result;
?>