<?php
if ($query->num_rows() > 0)
{	
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
			<div class="post_social">
				<a href="#" class="share_post"><img src="images/share.png" alt="" title="" /></a>              
			</div>
		</div>
		 
		<div class="page_content"> 
			<div class="entry">
				'.$post_content.'
				<input type="hidden" id="title" value="'.$title.'"/>
				<input type="hidden" id="image" value="'.$image.'"/>
				<input type="hidden" id="content" value="'.strip_tags($post_content).'"/>
			</div>
			
			<div class="post_social2">
				Share <a href="#" class="share_post"><img src="images/share.png" alt="" title="" /></a>              
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