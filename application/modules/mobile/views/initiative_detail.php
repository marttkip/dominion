<?php
if ($query->num_rows() > 0)
{
            
	foreach ($query->result() as $row)
	{
		$id = $row->post_id;
		$title = $row->post_title;

		$post_content = $row->post_content;
		$post_image = $row->post_image;
		$date = date('jS M Y',strtotime($row->created));
		$day = date('j',strtotime($row->created));
		$month = date('M',strtotime($row->created));
		$post_image = $row->post_image;
		$mini_string = (strlen($post_content) > 15) ? substr($post_content,0,50).'...' : $post_content;
		$mini_title = (strlen($title) > 15) ? substr($title,0,50).'...' : $title;
	}
	$item_post = '
		<div class="page_content"> 
			
			<img src="'.base_url().'assets/img/posts/'.$post_image.'" alt="" title="" />
			'.$post_content.'    
		  </div>	          
	          ';
}else
{
	$item_post = 'Data not found';
}

$result = '  <div class="navbarpages">
		       <div class="nav_left_logo"><a href="index.html"><img src="images/crown86.png" alt="" title="" /></a></div>
		       <div class="nav_right_button">
		       	<a href="#" data-popup=".popup-menu" class="open-popup"><img src="images/icons/white/menu.png" alt="" title="" /></a>
		       	<a href="initiative-page.html?id='.$parent_id.'" onClick="get_initiative_page('.$parent_id.')"><img src="images/icons/white/back.png" alt="" title=""  /></a>
		       </div>
		     </div>
		     <div id="pages_maincontent">
		          <h2 class="page_title">'.$title.'</h2>
		          '.$item_post.'
		      </div>
		      ';

echo $result;
?>