<?php
		$result = '';
		
		//if users exist display them
		if ($events->num_rows() > 0)
		{
			foreach ($events->result() as $row)
			{
				$event_id = $row->event_id;
				$event_status = $row->event_status;
				$event_name = $row->event_name;
				$image = base_url().'assets/event/'.$row->event_image_name;
				$web_name = $this->site_model->create_web_name($event_name);
				$description = $row->event_description;
				$mini_desc = implode(' ', array_slice(explode(' ', strip_tags($description)), 0, 50));
				$start_date = date('jS M Y',strtotime($row->event_start_time));
				$start_time = date('H:i a',strtotime($row->event_start_time));
				
				$result .= 
				'
				<div class="col-md-4">
					<article class="element-box event-item">
						
						<figure>
							<a href="'.site_url().'event/'.$web_name.'">
								<img src="'.$image.'" alt="'.$event_name.'">
							</a>
						</figure>
	
						<h3 class="green-bage">
							<a href="'.site_url().'event/'.$web_name.'">'.$event_name.'</a>
						</h3>
	
						<p>
							'.$mini_desc.'
						</p>
	
						<footer class="events-bottom-bar clearfix">
							<b>'.$start_date.'</b>
							<b class="time-info fr">'.$start_time.'</b>
						</footer>
	
					</article> <!-- /.col-md-4 -->
				</div>
				';
			}
		}
		
		else
		{
			$result .= "There are no events :-(";
		}
		
	echo $this->load->view('site/includes/navigation', '', TRUE);
		
		
?>