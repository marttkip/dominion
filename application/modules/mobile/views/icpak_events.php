<?php

$result = '<div class="page_content"> 
      
		    <div class="blog-posts">';
		       if ($query->num_rows() > 0)
                {

                $result .=' 

                      <ul class="posts-events">';

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
                            $mini_title = (strlen($title) > 30) ? substr($title,0,52).'...' : $title;
                            $result .='
                                <li>
                                    <div class="post_entry">
                                        <div class="post_date">
                                            <span class="day">'.$day.'</span>
                                            <span class="month">'.$month.'</span>
                                        </div>
                                        <div class="post_title">
                                       		<h3><a href="event-single.html?id='.$id.'" onclick="get_events_description('.$id.')">'.strip_tags($mini_title,'<p><a>').'</a></h3>
                                       		'.$venue.'. Entry : KES'.$price.' 
                                        </div>
                                    </div>
                                </li>';
                        }
                        $result .='
                      </ul>
                    <div class="clear"></div>  
	                    <div id="loadMore"><img src="images/load_posts.png" alt="" title="" /></div> 
	                    <div id="showLess"><img src="images/load_posts_disabled.png" alt="" title="" /></div> 
                    </div>
                      ';
                    }
                    else
                    {
                        $result .= "There are no blog categories";
                    }
            $result .= '                
				</div>';
	echo $result;
?>