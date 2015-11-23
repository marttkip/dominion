<?php
if ($query->num_rows() > 0)
{
            
	foreach ($query->result() as $row)
	{
		$id = $row->post_id;
		$title = $row->post_title;

		$post_content = $row->post_content;
		$post_image = $row->post_image;
		$post_audio = $row->post_audio;
		$post_video = $row->post_video;
		$date = date('jS M Y',strtotime($row->created));
		$day = date('j',strtotime($row->created));
		$month = date('M',strtotime($row->created));

		$mini_string = (strlen($post_content) > 15) ? substr($post_content,0,50).'...' : $post_content;
		$mini_title = (strlen($title) > 15) ? substr($title,0,50).'...' : $title;
	}
	$result ='';
	
	$result .= '
	<div class="page_content"> 
		<blockquote>'.strip_tags($title).'</blockquote>
		<img src="'.base_url().'assets/img/posts/'.$post_image.'" alt="" title="" />';
		if(!empty($post_audio))
		{
		$result .= '
		<blockquote>
			Audio
			<audio controls>
				<source src="'.base_url().'assets/img/posts/'.$post_audio.'" type="audio/mpeg" class="align-centre">
				Your browser does not support the audio element.
			</audio>
		</blockquote>
		';
		}
		if(!empty($post_video))
		{
			$result .= '
		<blockquote>
			<iframe width="560" height="315" frameborder="0" allowfullscreen="" src="'.base_url().'assets/img/posts/'.$post_video.'?rel=0&amp;showinfo=0&amp;iv_load_policy=3&amp;modestbranding=1&amp;autohide=1&amp;controls=0;"></iframe>
		</blockquote>
		';
		}
		$result .='<p>'.$post_content.'</p>
	</div>
	
	<blockquote>
	</blockquote>';
}else
{
	$result = 'Sermon not found';
}
echo $result;
?>