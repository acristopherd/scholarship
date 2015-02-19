<?php $page_title = "Send Message"; 
$style='<link href="'.base_url().'css/htmlarea/jHtmlArea.css" rel="stylesheet">
		<style type = "text/css">
			input{
				text-transform:capitalize;
			}
		</style>'?>
<?php include("includes/header.php");?>
<div id="container main-container">
    
    <div class="row">
    <div class="wrapper col-lg-6">
    <div class="panel panel-primary">
    	<div class="panel-heading">
    		Send Message
    	</div>
    	<div class="panel-body">
    		
    		<?php echo form_open_multipart("message/sponsor_to_admin",array("class"=>"form"));?>	
    			    	
	    		<div class="">	    			
	    			<div class="form-group col-lg-8">
	                    <label class="control-label" for="a_title">Subject</label>
	                    <?php echo form_input(array("name"=>"a_title","class"=>"form-control input-sm","placeholder"=>"Subject"),set_value("a_title")); 
	                    		echo form_error("a_title");?>
	                </div>
	                
	               
	                <div class="form-group col-lg-12">
	                    <label class="control-label" for="a_msg">Message</label>
	                    <?php echo form_textarea(array("name"=>"a_msg","id"=>"a_msg","class"=>"form-control input-sm","placeholder"=>"Message"),set_value("a_msg"));
								echo form_error("a_msg"); ?>
	                </div>
	                <div class="form-group col-lg-12">
	                    <label class="control-label" for="attachment[]">Attachment</label>
	                    <?php echo form_input(array("name"=>"attachment[]","type"=>"file","class"=>"form-control input-sm","placeholder"=>"Pictures","multiple"=>"","accept"=>""));
								echo form_error("a_"); ?>
	                </div>
	    		</div>
	    		<div class="form-group col-md-8 col-lg-4">
	    			<?php echo form_submit(array("value"=>"Send","class"=>"form-control btn btn-primary")) ?>
	    		</div>		    
	    		
		    <?php echo form_close();?>
    	</div>
    </div>    	
    </div>
    </div>
    
    
</div>
<?php include("includes/footer.php");
?>
