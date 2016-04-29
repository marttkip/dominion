<?php
// var_dump($query);
foreach ($query->result() as $key) {
	$service_id = $key->service_id;
	$service_name = $key->service_name;
	$service_description = $key->service_description;
	$created = $key->created;
	$department_name = $key->department_name;
	$created_on = date('jS M Y H:i a',strtotime($key->created));
}

?>
<div id="content-container">
        <div id="content" class="clearfix">
            <div id="main-content">
                <div id="breadcrumbs" class="clearfix">
                    <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                        <a href="<?php echo site_url();?>home" itemprop="url" class="icon-home">
                            <span itemprop="title">Home</span>
                        </a> <span class="arrow">&gt;</span>
                    </div>  
                    <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                        <a href="#" itemprop="url">
                            <span itemprop="title">About</span>
                        </a> <span class="arrow">&gt;</span>
                    </div>  
                    <span class="last-breadcrumbs">
                        <?php echo $service_name;?>
                    </span>
                </div>
                <article class="static-page news">
                    <header class="clearfix">
                       <!--  <figure>
                            <img src="<?php echo $image;?>" data-retina="<?php echo $image;?>" alt="<?php echo $post_title;?>" />
                        </figure> -->
                        <aside>
                            <h1 id="news-title"><?php echo $service_name;?></h1>
                            <p id="link-category"><a href="#"><?php echo $department_name;?></a></p>
                            <p id="blog-time" class="clearfix"><time datetime="<?php echo $created_on;?>"><?php echo $created_on;?></time></p>
                            <ul id="social-link" class="clearfix">
				                <li><div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="http://cubicthemes.com" send="false" layout="button_count" width="40" show_faces="false" font=""></fb:like></li>
				                <li>
						              <a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
                                </li>
				                <li class="last">
                                    <div class="g-plusone" data-size="medium"></div>
                                    <script type="text/javascript">
                                      (function() {
                                        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                                        po.src = 'https://apis.google.com/js/plusone.js';
                                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                                      })();
                                    </script>
                                </li>
				            </ul>

                        </aside>
                    </header>
                    <p><?php echo $service_description;?></p>
                   </article>
             
            </div>
            <?php echo $this->load->view('about_us/includes/side_bar', '', TRUE);?>

            <?php echo $this->load->view('site/includes/content_tabs', '', TRUE);?>
        </div>
    </div>
