<?php 

$news_item_post ='';
if ($query->num_rows() > 0)
{
	$news_item_post .='<ul class="posts">';
	foreach ($query->result() as $news_items_row)
	{
		$id = $news_items_row->post_id;
		$title = $news_items_row->post_title;

		$post_content = $news_items_row->post_content;
		$date = date('jS M Y',strtotime($news_items_row->created));
		$day = date('j',strtotime($news_items_row->created));
		$month = date('M',strtotime($news_items_row->created));
		$post_image = $news_items_row->post_image;
		$mini_string = (strlen($post_content) > 15) ? substr($post_content,0,50).'...' : $post_content;
		$mini_title = (strlen($title) > 15) ? substr($title,0,50).'...' : $title;
		$news_item_post .='
			
			<li>
				<div class="post_entry">
					<div class="post_date">
						<span class="day">'.$day.'</span>
						<span class="month">'.$month.'</span>
					</div>
					<div class="post_title">
					<h3><a href="sermon.html?id='.$id.'" onclick="get_sermons_description('.$id.')">'.strip_tags($mini_title).'</a></h3>

					</div>
				</div>
			</li>';
	}
	$news_item_post .='</ul>';
}else
{
	$news_item_post = 'Data not found';
}


$result = '
	<div class="page_content">
		'.$news_item_post.'
	</div>';
echo $result;
?>