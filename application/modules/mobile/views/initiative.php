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
                      <div class="feat_small_details" style="margin:0 45px 3px;">
                      <h4>'.$title.'</h4>
                      <a href="initiative-page.html?id='.$id.'" onclick="get_initiative_page('.$id.')">'.$mini_string .'...</a>
                      </div>
                      <div class="view_more"><a href="initiative-page.html?id='.$id.'" onclick="get_initiative_page('.$id.')"><img src="images/load_posts_disabled.png" alt="" title="" /></a></div>
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