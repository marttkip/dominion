<?php 

$news_item_post ='';
if ($query->num_rows() > 0)
{
	$news_item_post .='<ul>';
	foreach ($query->result() as $news_items_row)
	{
		$id = $news_items_row->post_id;
		$title = $news_items_row->post_title;

		$post_content = $news_items_row->post_content;
		$date = date('jS M Y',strtotime($news_items_row->created));
		$day = date('j',strtotime($news_items_row->created));
		$month = date('M',strtotime($news_items_row->created));
		$post_image = $news_items_row->post_image;
		$mini_string = (strlen($post_content) > 15) ? substr($post_content,0,300).'...' : $post_content;
		$mini_title = (strlen($title) > 15) ? substr($title,0,50) : $title;
		$news_item_post .='
							<li class="item-content">
						      <a href="#" class="item-link item-content">
						        	 <div class="content-block-inner">
							          	<div class="article">
							              <div class="article-header">
							              </div>
							              <div class="article-content">
							              	  <h3>'.$title.' </h3>
							                  <p>'.$mini_string.'</p>
							                  <div class="event-items">
							                  	<div class="row">
							              			<div class="col-50">
							              				<strong>Theme : </strong> Uzuri Institute <br/>
							              				<strong>Venue : </strong> Uzuri Institute
							              			</div>
							              			<div class="col-50">
							              				<strong>Date : </strong> 8:00pm <br/>
							              				<strong>Time : </strong> 7:00am
							              			</div>
							              		</div>
							                  </div>

							              </div>

							              <div class="article-footer">
							              		<div class="row">
							              			<div class="col-33">
							              				Like
							              			</div>
							              			<div class="col-33">
							              				Share
							              			</div>
							              			<div class="col-33">
							              				Comment
							              			</div>
							              		</div>
							              </div>
							          </div>
							        </div>
						      </a>
						    </li>';
	}
	$news_item_post .='</ul>';
}else
{
	$news_item_post = 'Data not found';
}


$result = $news_item_post;
echo $result;
?>