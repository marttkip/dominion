          
          <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Edit post</h2>
                </header>
                <div class="panel-body">
                	<div class="row" style="margin-bottom:20px;">
                        <div class="col-lg-12">
                            <a href="<?php echo site_url();?>blog/posts" class="btn btn-info pull-right">Back to posts</a>
                        </div>
                    </div>
		  <style type="text/css">
		  	.add-on{cursor:pointer;}
		  </style>
          <div class="padd">
            <!-- Adding Errors -->
            <?php
			
            if(isset($error)){
                echo '<div class="alert alert-danger"> Oh snap! Change a few things up and try submitting again. </div>';
            }
			
			//the post details
			$post_id = $post[0]->post_id;
			$post_title = $post[0]->post_title;
			$post_status = $post[0]->post_status;
			$post_content = $post[0]->post_content;
			$post_video = $post[0]->post_video;
			$post_audio = $post[0]->post_audio;
			$image = $post[0]->post_image;
			$created = date('Y-m-d',strtotime($post[0]->created));
            
            $validation_errors = validation_errors();
            
            if(!empty($validation_errors))
            {
				$post_title = set_value('post_title');
				$post_status = set_value('post_status');
				$post_content = set_value('post_content');
				$created = set_value('created');
				
                echo '<div class="alert alert-danger"> Oh snap! '.$validation_errors.' </div>';
            }
            ?>
            
            <?php echo form_open_multipart($this->uri->uri_string(), array("class" => "form-horizontal", "role" => "form"));?>
            <div class="row">
                <div class="col-md-6">
                    <!-- post category -->
                    <div class="form-group">
                        <label class="col-md-4 control-label">Post Category</label>
                        <div class="col-md-8">
                            <?php echo $categories;?>
                        </div>
                    </div>
                    <!-- post Name -->
                    <div class="form-group">
                        <label class="col-md-4 control-label">Post Title</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="post_title" placeholder="Post Title" value="<?php echo $post_title;?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Post Date</label>
                        
                        <div class="col-md-8">
                            <div id="datetimepicker1" class="input-append">
                                <input data-format="yyyy-MM-dd" class="form-control" type="text" name="created" placeholder="Post Date" value="<?php echo $created;?>">
                                <span class="add-on">
                                    &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar">
                                    </i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- Image -->
                    <div class="form-group">
                        <label class="col-md-4 control-label">Post Image</label>
                        <input type="hidden" value="<?php echo $image;?>" name="current_image"/>
                        <input type="hidden" value="<?php echo $post_audio;?>" name="current_audio"/>
                        <div class="col-md-8">
                            
                            <div class="row">
                            
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width:200px; height:200px;">
                                            <img src="<?php echo base_url()."assets/img/posts/".$image;?>">
                                        </div>
                                        <div>
                                            <span class="btn btn-file btn-info"><span class="fileinput-new">Select Image</span><span class="fileinput-exists">Change</span><input type="file" name="post_image"></span>
                                            <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!-- Activate checkbox -->
                    <div class="form-group">
                        <label class="col-md-4 control-label">Activate Post?</label>
                        <div class="col-md-4">
                            <div class="radio">
                                <label>
                                    <?php
                                    if($post_status == 1){echo '<input id="optionsRadios1" type="radio" checked value="1" name="post_status">';}
                                    else{echo '<input id="optionsRadios1" type="radio" value="1" name="post_status">';}
                                    ?>
                                    Yes
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <?php
                                    if($post_status == 0){echo '<input id="optionsRadios1" type="radio" checked value="0" name="post_status">';}
                                    else{echo '<input id="optionsRadios1" type="radio" value="0" name="post_status">';}
                                    ?>
                                    No
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Video</label>
                        
                        <div class="col-md-8">
                            <input type="text" name="post_video" class="form-control" value="<?php echo $post_video;?>"/>
                            <?php 
                            if(!empty($post_video))
                            {
                            ?>
                            <iframe width="560" height="315" frameborder="0" allowfullscreen="" src="<?php echo site_url().'assets/img/posts/'.$post_video;?>?rel=0&amp;showinfo=0&amp;iv_load_policy=3&amp;modestbranding=1&amp;autohide=1&amp;controls=0;"></iframe>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Audio</label>
                        
                        <div class="col-md-8">
                            <input type="text" name="post_audio" class="form-control" value="<?php echo $post_audio;?>"/>
                            <?php 
                            if(!empty($post_audio))
                            {
                            ?>
                            <audio controls>
                                <source src="<?php echo site_url().'assets/img/posts/'.$post_audio;?>" type="audio/mpeg" class="align-centre">
                            	Your browser does not support the audio element.
                            </audio>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <!-- post content -->
                    <div class="form-group">
                        <label class="col-md-12 control-label">Post Content</label>
                        <div class="col-md-12" style="height:500px;">
                            <textarea class="cleditor" name="post_content" placeholder="Post Content"><?php echo $post_content;?></textarea>
                        </div>
                    </div>
                    <div class="form-actions center-align">
                        <button class="submit btn btn-primary" type="submit">
                            Edit post
                        </button>
                    </div>
                </div>
            </div>
            
            <?php echo form_close();?>
		</div>
                </div>
            </section>