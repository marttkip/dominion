<?php
$result = '';
    if ($query->num_rows() > 0)
    {

    $result .=' 
          <ul class="features_list_detailed">';
            foreach ($query->result() as $row)
            {
                $id = $row->post_id;
                $title = $row->post_title;

                $post_content = $row->post_content;
                $date = date('jS M Y',strtotime($row->created));
                $day = date('j',strtotime($row->created));
                $month = date('M',strtotime($row->created));
		$post_image = $row->post_image;
                $mini_string = (strlen($post_content) > 50) ? substr($post_content,0,200).'...' : $post_content;
                $mini_title = (strlen($title) > 15) ? substr($title,0,50).'...' : $title;
                $result .='
		           <li>
			          <div class="feat_small_icon"><img src="'.base_url().'assets/img/posts/'.$post_image.'" alt="" title="" /></div>
			          <div class="feat_small_details">
			          <h4>'.$title.'</h4>
			          <a href="dominion-generation.html?id='.$id.'" onclick="get_arms_description('.$id.')">'.$mini_string .'...</a>
			          </div>
			          <div class="view_more"><a href="dominion-generation.html?id='.$id.'" onclick="get_arms_description('.$id.')"><img src="images/load_posts_disabled.png" alt="" title="" /></a></div>
			   </li>
			   ';
	      }
              $result .='</ul>';
        }
        else
        {
            $result .= "There are no posts";
        }
echo $result;
?>