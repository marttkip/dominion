 <?php
if ($initiative_page_query->num_rows() > 0)
{            
	foreach ($initiative_page_query->result() as $initiative_row)
	{
		$page_title = $initiative_row->post_title;

		$page_post_content = $initiative_row->post_content;
	}
	
}else
{
}

$initiative_projects = '';
if ($query->num_rows() > 0)
{

$initiative_projects .=' 

   <ul id="photoslist" class="photo_gallery_13">';
    foreach ($query->result() as $row)
    {
        $id = $row->post_id;
        $title = $row->post_title;

        $post_content = $row->post_content;
        $date = date('jS M Y',strtotime($row->created));
        $day = date('j',strtotime($row->created));
        $month = date('M',strtotime($row->created));

        $mini_string = (strlen($post_content) > 15) ? substr($post_content,0,50).'...' : $post_content;
        $mini_title = (strlen($title) > 15) ? substr($title,0,50).'...' : $title;
        $post_image = $row->post_image;
        $initiative_projects .='
            <li><a href="initiative-detail.html?id='.$id.'" onclick="get_initiatives_description('.$id.','.$parent_id.');" title="'.$title.'" ><img src="'.base_url().'assets/img/posts/'.$post_image.'" alt="'.$title.'"/></a></li>

            <div class="clearleft"></div>
            ';
    }
    $initiative_projects .='
  </ul>';
}
else
{
    $initiative_projects .= "There are no posts";
}

 $result = '<h2 class="page_title">'.$page_title.'</h2>
          
          
          <div class="page_content">
              <div class="buttons-row">
                    <a href="#tab3" class="tab-link active button">About '.$page_title.'</a>
                    <a href="#tab5" class="tab-link button">Projects</a>
              </div>
              <div class="tabs-simple">
                    <div class="tabs">
                    	  <div id="tab3" class="tab active">
				              <div class="page_content"> 
				              <blockquote>
				             	'.$page_title.'
				              </blockquote>				              
								<p>'.$page_post_content.'</p>				              
				              </div>
                    	  </div>
                    	  
                          <div id="tab5" class="tab">
						            
						      '.$initiative_projects.'
	      
                          </div>
    
                          
                          
                         
                    </div>
              </div>
          
          </div>';
echo $result;
?>