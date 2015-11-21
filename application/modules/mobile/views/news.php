<?php 

$news_item_post ='';
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
		$news_item_post .= '
				<div class="accordion-item">
                    <div class="accordion-item-toggle">
                      <i class="icon icon-plus">+</i>
                      <i class="icon icon-minus">-</i>
                      <span>'.$title.'</span>
                    </div>
                    <div class="accordion-item-content">
                           '.$post_content.'
                    </div>
                  </div>
              ';
	}
	
}else
{
	$news_item_post = 'Data not found';
}

$result = '
	<div class="page_content">
		<div class="custom-accordion">
		'.$news_item_post.'
	 	</div>
	</div>';
echo $result;
?>