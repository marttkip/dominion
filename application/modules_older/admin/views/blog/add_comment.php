                   
						<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
								</div>
						
								<h2 class="panel-title"><?php echo $title;?></h2>
							</header>
							<div class="panel-body">
                            	<div class="row" style="margin-bottom:20px;">
                                    <div class="col-lg-12">
                                    	<a href="<?php echo site_url().'blog/comments';?>" class="btn btn-success pull-right">Back to comments</a>
                                    </div>
                                </div>
            <!-- Adding Errors -->
            <?php
            if(isset($error)){
                echo '<div class="alert alert-danger">'.$error.'</div>';
            }
            
            $validation_errors = validation_errors();
            
            if(!empty($validation_errors))
            {
                echo '<div class="alert alert-danger"> Oh snap! '.$validation_errors.' </div>';
            }
			echo '<p><strong>Post Title: </strong>'.$title.'</p>';
            ?>
            
            <?php echo form_open($this->uri->uri_string(), array("class" => "form-horizontal", "role" => "form"));?>
            <!-- post comment -->
            <div class="form-group">
                <label class="col-lg-2 control-label">Comment</label>
                <div class="col-lg-10">
                    <textarea class="cleditor" name="post_comment_description" placeholder="Post Content"><?php echo set_value('post_comment_description');?></textarea>
                </div>
            </div>
            <div class="form-actions center-align">
                <button class="submit btn btn-primary" type="submit">
                    Add Comment
                </button>
            </div>
            <br />
            <?php echo form_close();?>
							</div>
							<div class="panel-body">
                            	<?php if(isset($links)){echo $links;}?>
							</div>
						</section>