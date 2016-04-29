 	<!-- Gallery updates -->
    <div class="gallery-updates cols5 clearfix">
    	<ul>
        	<?php
            if($gallery->num_rows() > 0)
            {
                foreach($gallery->result() as $department)
                {
                    $gallery_image_name = $department->gallery_image_name;

                    ?>
                    <li class="format-image"><a href="<?php echo $gallery_location.$gallery_image_name;?>" data-rel="prettyPhoto" class="media-box"><img src="<?php echo $gallery_location.$gallery_image_name;?>" alt=""></a></li>
                    <?php
                }
            }
            ?>
                    <li class="format-standard">
                        <div class="flexslider galleryflex" data-autoplay="yes" data-pagination="yes" data-arrows="no" data-style="slide" data-pause="yes">
                            <ul class="slides">
                                <li class="item"><a href="../images/gallery_img5.jpg" data-rel="prettyPhoto[postname1]"><img src="../images/gallery_img5.jpg" alt=""></a></li>
                                <li class="item"><a href="../images/event_img2.jpg" data-rel="prettyPhoto[postname1]"><img src="../images/gallery_img4.jpg" alt=""></a></li>
                            </ul>
                        </div>
                    </li>
      	</ul>
        <div class="gallery-updates-overlay">
        	<div class="container">
            	<i class="icon-multiple-image"></i>
                <h2>Updates from our gallery</h2>
            </div>
        </div>
    </div>
    