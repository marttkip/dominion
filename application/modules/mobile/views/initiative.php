<?php
$church = '';
if ($query->num_rows() > 0)
{

$church .=' 

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
        $church .='
            <li><a href="initiative-detail.html?id='.$id.'" onclick="get_initiatives_description('.$id.');" title="'.$title.'" ><img src="'.base_url().'assets/img/posts/'.$post_image.'" alt="'.$title.'"/></a></li>

            <div class="clearleft"></div>
            ';
    }
    $church .='
  </ul>';
}
else
{
    $church .= "There are no posts";
}


$corporates_view = '';
if ($corporates->num_rows() > 0)
{

$corporates_view .=' 

   <ul id="photoslist" class="photo_gallery_13">';
    foreach ($corporates->result() as $corporates_row)
    {
        $id = $corporates_row->post_id;
        $post_title = $corporates_row->post_title;

        $post_content = $corporates_row->post_content;
        $date = date('jS M Y',strtotime($corporates_row->created));
        $day = date('j',strtotime($corporates_row->created));
        $month = date('M',strtotime($corporates_row->created));

        $mini_string = (strlen($post_content) > 15) ? substr($post_content,0,50).'...' : $post_content;
        $mini_title = (strlen($title) > 15) ? substr($title,0,50).'...' : $title;
         $post_image = $corporates_row->post_image;
         $corporates_view .='
            <li><a href="initiative-detail.html?id='.$id.'" onclick="get_initiatives_description('.$id.');" title="'.$title.'" ><img src="'.base_url().'assets/img/posts/'.$post_image.'" alt="'.$title.'"/></a></li>

            <div class="clearleft"></div>
            ';
    }
    $corporates_view .='</ul>';
}
else
{
    $corporates_view .= "There are no posts";
}

$learning_view = '';
if ($learning->num_rows() > 0)
{

$learning_view .='<ul id="photoslist" class="photo_gallery_13">';
    foreach ($learning->result() as $learning_row)
    {
        $id = $learning_row->post_id;
        $title3 = $learning_row->post_title;

        $post_content = $learning_row->post_content;
        $date = date('jS M Y',strtotime($learning_row->created));
        $day = date('j',strtotime($learning_row->created));
        $month = date('M',strtotime($learning_row->created));

        $mini_string = (strlen($post_content) > 15) ? substr($post_content,0,50).'...' : $post_content;
        $mini_title = (strlen($title) > 15) ? substr($title,0,50).'...' : $title;
         $post_image = $learning_row->post_image;
        $learning_view .='
            <li><a href="initiative-detail.html?id='.$id.'" onclick="get_initiatives_description('.$id.');" title="'.$title3.'" ><img src="'.base_url().'assets/img/posts/'.$post_image.'" alt="'.$title3.'"/></a></li>

            <div class="clearleft"></div>
            ';
    }
 $learning_view .='</ul>';
}
else
{
    $learning_view .= "There are no posts";
} 

$individual_view = '';
if ($individual->num_rows() > 0)
{

$individual_view .='<ul id="photoslist" class="photo_gallery_13">';
    foreach ($individual->result() as $individual_row)
    {
        $id = $individual_row->post_id;
        $title3 = $individual_row->post_title;

        $post_content = $individual_row->post_content;
        $date = date('jS M Y',strtotime($individual_row->created));
        $day = date('j',strtotime($individual_row->created));
        $month = date('M',strtotime($individual_row->created));

        $mini_string = (strlen($post_content) > 15) ? substr($post_content,0,50).'...' : $post_content;
        $mini_title = (strlen($title) > 15) ? substr($title,0,50).'...' : $title;
         $post_image = $individual_row->post_image;
        $learning_view .='
            <li><a href="initiative-detail.html?id='.$id.'" onclick="get_initiatives_description('.$id.');" title="'.$title3.'" ><img src="'.base_url().'assets/img/posts/'.$post_image.'" alt="'.$title3.'"/></a></li>

            <div class="clearleft"></div>
            ';
    }
 $individual_view .='</ul>';
}
else
{
    $individual_view .= "There are no posts";
} 

$result = '<div class="tabs">
                  <div id="tab1p" class="tab active">
                   	'.$church.'
                  </div>

                  <div id="tab2p" class="tab">
                  	'.$corporates_view.'
                  </div> 
                  
                  <div id="tab3p" class="tab">
                    '.$learning_view.'
                  </div>
                   <div id="tab4p" class="tab">
                    '.$individual_view.'
                  </div> 
                  
            </div> ';                  
echo $result;
?>