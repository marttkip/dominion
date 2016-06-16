<?php 

$result = '';

if ($query->num_rows() > 0)
{
	foreach ($query->result() as $row)
	{
		$id = $row->post_id;
		$title = $row->post_title;

		$post_content = $row->post_content;
		$date = date('jS M Y',strtotime($row->created));
		$day = date('j',strtotime($row->created));
		$month = date('M',strtotime($row->created));
		$post_image = $row->post_image;
		$mini_string = (strlen($post_content) > 15) ? substr($post_content,0,50).'...' : $post_content;
		$mini_title = (strlen($title) > 15) ? substr($title,0,50).'...' : $title;
		$result .='
			<li>
				<a href="dist/blog-single.html" onclick="get_blog_description('.$id.')" class="item-link item-content">
					<div class="item-media">
						<i class="fa fa-calendar"></i>
						<div class="post_date">
							<span class="day">'.$day.'</span>
							<span class="month">'.$month.'</span>
						</div>
					</div>
					<div class="item-inner">
						<div class="item-title">'.strip_tags($mini_title).'</div>
					</div>
				</a>
			</li>';
	}
}
else
{
	$result .= "There are no forums";
}
echo $result;