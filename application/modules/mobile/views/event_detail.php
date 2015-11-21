<?php
if ($query->num_rows() > 0)
{
            
	foreach ($query->result() as $row)
	{
		$cat = $row;
		$id = $cat->event_id;
		$event_status = $cat->event_status;
		$event_name = $cat->event_name;
		$event_start_time = $cat->event_start_time;
		$starts = date('jS M Y H:i a',strtotime($cat->event_start_time));
		$ends = date('jS M Y H:i a',strtotime($cat->event_end_time));
		$event_image_name = 'thumbnail_'.$cat->event_image_name;
		$meeting_date = date('jS M Y',strtotime($event_start_time));
		$day = date('j',strtotime($event_start_time));
		$month = date('M',strtotime($event_start_time));
		$meeting_content = $row->event_description;
		$price = number_format($row->event_admission, 2);
		$venue = $row->event_venue;
	    if(is_int($day))
	     {
	        $day = '0$day';
	     }
	     else
	     {
	        $day = $day;
	     }

	    // $meeting_mini_string = (strlen($meeting_content) > 15) ? substr($meeting_content,0,50).'...' : $meeting_content;
		$title = strip_tags($event_name,'<p><a>');
	    $mini_title = (strlen($title) > 15) ? substr($title,0,50).'...' : $title;
	}
	$result = '<h2 class="page_title">'.strip_tags($title).'</h2>
	 
	          <div class="post_single">
	                 
	            <div class="page_content"> 

	              <div class="entry">
	              <h3>Event Detail:</h3>
	              <ul class="simple_list">
		              <li>Dates : '.$meeting_date.'</li>
		              <li>Venue : '.$venue.'</li>
		              <li>Entry : KES'.$price.'</li>
	              </ul>
	              	'.$meeting_content.'
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