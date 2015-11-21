<?php
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
	}
	$result = '
		<h2 class="page_title">'.strip_tags($title).'</h2>
	          <div class="post_single">
	            <div class="page_content"> 
	              <div class="entry">
	              	'.$post_content.'
	              </div>
	            </div>
	          </div>	          
	          ';
}else
{
	$result = 'Data not found';
}
echo $result;
?>