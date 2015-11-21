<?php
$post_item = '';
if ($query->num_rows() > 0)
{
            
	foreach ($query->result() as $row)
	{
		$id = $row->post_id;
		$post_title = $row->post_title;

		$post_content = $row->post_content;
		$date = date('jS M Y',strtotime($row->created));
		$day = date('j',strtotime($row->created));
		$month = date('M',strtotime($row->created));
		$post_image = $row->post_image;
		$mini_string = (strlen($post_content) > 15) ? substr($post_content,0,30).'...' : $post_content;
		$mini_title = (strlen($post_title) > 15) ? substr($post_title,0,30).'...' : $post_title;
	}
	$post_item = '
		<blockquote>
              	About '.$post_title.'
              </blockquote>
              
              <img src="'.base_url().'assets/img/posts/'.$post_image.'" alt="" title="" />
		<p>'.$post_content.'</p>
              ';
}else
{
	$post_item = 'Data not found';
}


$news_items = '';
if($post_title == "About Us")
{
   $news_category = 19;
   $events_category = 20;
}
else if($post_title == "Arms")
{
   $news_category = 8;
   $events_category = 11;
}
else if($post_title == "Empowerment Forums")
{
   $news_category = 21;
   $events_category = 22;
}
$new_items = $this->arms_model->get_arms_news_items($news_category);
$news_item_post ='';
if ($new_items->num_rows() > 0)
{
            
	foreach ($new_items->result() as $news_items_row)
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


$events_items = $this->arms_model->get_arms_events_items($events_category);


$events_item_post ='';
if ($events_items->num_rows() > 0)
{
            
	foreach ($events_items->result() as $events_items_row)
	{
		$id = $events_items_row->post_id;
		$title = $events_items_row->post_title;
		$post_content = $events_items_row->post_content;
		$date = date('jS M Y',strtotime($events_items_row->created));
		$day = date('j',strtotime($events_items_row->created));
		$month = date('M',strtotime($events_items_row->created));
		$post_image = $events_items_row->post_image;
		$mini_string = (strlen($post_content) > 15) ? substr($post_content,0,50).'...' : $post_content;
		$mini_title = (strlen($title) > 15) ? substr($title,0,50).'...' : $title;
		$events_item_post .='
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
	$events_item_post = 'Data not found';
}

if($post_title == "Arms")
{
 $tab = '<a href="#tab4" class="tab-link button">Programs</a>';
}
else
{
  $tab = '<a href="#tab4" class="tab-link button">Latest News</a>';
}
$result = 
'
<div class="buttons-row">
	<a href="#tab3" class="tab-link active button">About</a>
	'.$tab.'
	<a href="#tab5" class="tab-link button">Upcoming Events</a>
</div>

<div class="tabs-simple">
    <div class="tabs">
          <div id="tab3" class="tab active">  
	     <div class="page_content"> 
              '.$post_item.'
             </div>
          </div>

          <div id="tab4" class="tab">
               <div class="custom-accordion">
        	'.$news_item_post.'
                </div> 
          </div> 
          
          <div id="tab5" class="tab">
               <div class="custom-accordion">
               	   '.$events_item_post.'
               </div>
                        
          </div>
    </div>
</div>
';
echo $result;
?>