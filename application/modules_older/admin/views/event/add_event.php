   
        <!-- Jasny -->
        <link href="<?php echo base_url();?>assets/jasny/jasny-bootstrap.css" rel="stylesheet">		
        <script type="text/javascript" src="<?php echo base_url();?>assets/jasny/jasny-bootstrap.js"></script> 
          
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
                            <a href="<?php echo site_url();?>events" class="btn btn-info pull-right">Back to events</a>
                        </div>
                    </div>
                        
                    <!-- Adding Errors -->
                    <?php
                    if(isset($error))
					{
						if(!empty($error))
						{
                        	echo '<div class="alert alert-danger">'.$error.' </div>';
						}
                    }
                    
                    $validation_errors = validation_errors();
                    
                    if(!empty($validation_errors))
                    {
                        echo '<div class="alert alert-danger"> Oh snap! '.$validation_errors.' </div>';
                    }
                    ?>
			
				<?php
				$attributes = array('role' => 'form');
		
				echo form_open_multipart($this->uri->uri_string(), $attributes);
				
				if(!empty($error))
				{
					?>
					<div class="alert alert-danger">
						<?php echo $error;?>
					</div>
					<?php
				}
				?>
                <div class="row">
                	<div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="event_name">Event Name</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" name="event_name" placeholder="Event Name" value="<?php echo set_value("event_name");?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="event_name">Event venue</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" name="event_venue" placeholder="Event Venue" value="<?php echo set_value("event_venue");?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="event_name">Event Location</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" name="event_location" placeholder="Event location" value="<?php echo set_value("event_location");?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="event_name">Event start date</label>
                            <div class="col-sm-9">
                            	<div class="row">
                                	<div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="text" class="form-control" data-plugin-datepicker="" name="event_start_date" placeholder="Event start date" value="<?php echo set_value("event_start_date");?>">
                                        </div>
                                	</div>
                                    
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </span>
                                            <input type="text" data-plugin-options="{ &quot;showMeridian&quot;: false }" class="form-control" data-plugin-timepicker="" name="event_start_time" placeholder="Event start time" value="<?php echo set_value("event_start_time");?>">
                                        </div>
                                	</div>
                               </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="event_name">Event end date</label>
                            <div class="col-sm-9">
                            	<div class="row">
                                	<div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="text" class="form-control" data-plugin-datepicker="" name="event_end_date" placeholder="Event end date" value="<?php echo set_value("event_end_date");?>">
                                        </div>
                                	</div>
                                    
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </span>
                                            <input type="text" data-plugin-options="{ &quot;showMeridian&quot;: false }" class="form-control" data-plugin-timepicker="" name="event_end_time" placeholder="Event end time" value="<?php echo set_value("event_end_time");?>">
                                        </div>
                                	</div>
                               </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="event_name">Event admission cost</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" name="event_admission" placeholder="Event admission cost" value="<?php echo set_value("event_admission");?>">
                            </div>
                        </div>
					</div>
                	<div class="col-md-6">
                        <label class="col-sm-3 control-label" for="image">Event Image</label>
                        <div class="col-sm-9">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 400px; height: 400px;">
                                    <img src="<?php echo $event_location;?>" class="img-responsive"/>
                                </div>
                                <div>
                                    <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="event_image"></span>
                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
                
                <div class="row">
                	<div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="event_description">Event description</label>
                            <div class="col-sm-9">
                            	<textarea class="cleditor" name="event_description"><?php echo set_value("event_description");?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
				
				<div class="form-group center-align">
					<input type="submit" value="Add Event" class="login_btn btn btn-success btn-lg">
				</div>
				<?php
					echo form_close();
				?>
                </div>
            </section>