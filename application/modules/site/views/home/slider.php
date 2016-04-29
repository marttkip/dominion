<?php
if($slides->num_rows() > 0)
{
	$slides_no = $slides->num_rows();
	?>
     <!-- Start Hero Slider -->
    <div class="hero-slider heroflex flexslider clearfix" data-autoplay="yes" data-pagination="no" data-arrows="yes" data-style="fade" data-speed="7000" data-pause="yes">
      	<ul class="slides">
        	<?php
				$count = -1;
				foreach($slides->result() as $cat)
				{			
					$slideshow_id = $cat->slideshow_id;
					$slideshow_status = $cat->slideshow_status;
					$slideshow_name = $cat->slideshow_name;
					$slideshow_description = $cat->slideshow_description;
					$slideshow_image_name = $cat->slideshow_image_name;
					$slideshow_thumb_name = 'thumbnail_'.$cat->slideshow_image_name;
					$active = '';
					$count++;
					
					if($count == 1)
					{
						$active = 'rs_mainslider_items_active';
					}
				?>
                <li class="parallax" style="background-image:url(<?php echo $slideshow_location.$slideshow_image_name;?>);">
                    <div class="flex-caption" data-appear-animation="fadeInRight" data-appear-animation-delay="500">
                        <strong><?php echo $slideshow_name;?></strong>
                        <p><?php echo $slideshow_description;?></p>
                    </div>
                </li>
				<?php
				}
			?>
      	</ul>
        <canvas id="canvas-animation"></canvas>
    </div>
    <!-- End Hero Slider -->
       
<?php
}
?>
		