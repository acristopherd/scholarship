<?php $data['page_title'] = "Send Message"; 
$data['style']='<link href="'.base_url().'css/htmlarea/jHtmlArea.css" rel="stylesheet">
		<style type = "text/css">
			input{
				text-transform:capitalize;
			}
		</style>'?>
<?php $this->load->view('includes/header.php',$data);?>
<div class="container main-container">
    
    <div class="row">
    <div class="wrapper span6 col-md-7 col-sm-10">
    <div class="panel panel-primary">
    	<div class="panel-heading">
    		Create Message
    	</div>
    	<div class="panel-body">
    		
    		<?php echo form_open_multipart("message/sponsor_to_admin",array("class"=>"form"));?>	
    			 <?php if(isset($error))echo $error?>  	
	    		<div class="">	    			
	    			<div class="form-group span8">
	                    <label class="control-label" for="a_to">To</label>
	                    <?php echo form_dropdown('a_to',array("1"=>"Admin","7"=>"Scholars"),set_value("a_to"),'class="form-control input-sm"'); 
	                    		echo form_error("a_to");?>
	                </div>	
	    			<div class="form-group span8">
	                    <label class="control-label" for="a_title">Subject</label>
	                    <?php echo form_input(array("name"=>"a_title","class"=>"form-control input-sm","placeholder"=>"Subject"),set_value("a_title")); 
	                    		echo form_error("a_title");?>
	                </div>
	                
	               
	                <div class="form-group span12">
	                    <label class="control-label" for="a_msg">Message</label>
	                    <?php echo form_textarea(array("name"=>"a_msg","id"=>"a_msg","class"=>"form-control input-sm","placeholder"=>"Message"),set_value("a_msg"));
								echo form_error("a_msg"); ?>
	                </div>
	                <div class="form-group span12">
	                    <label class="control-label" for="attachment" id ="attachment-label">Attachment</label>
	                    <?php //echo form_input(array("name"=>"attachment","type"=>"file","class"=>"form-control input-sm","placeholder"=>"","multiple"=>"","accept"=>""));
								//echo form_error("attachment"); ?>
						<div class="btn btn-primary" id ="btn-attach">Attach File</div>
	                </div>
	    		</div>
	    		<div class="form-group col-md-8 span4">
	    			<?php echo form_submit(array("value"=>"Send","class"=>"form-control btn btn-primary")) ?>
	    		</div>		    
	    		
		    <?php echo form_close();?>
    	</div>
    </div>    	
    </div>
    </div>
    
    
</div>
<?php $this->load->view('includes/footer.php',$data);?>
<script>
	$(document).ready(function(){
		$("#btn-attach").click(function(){
			a = $("<input>").attr('type','file').attr('name','attachment[]').attr('multiple','multiple').addClass('form-control input-sm');
			$(this).before($(a)).remove();
		});
	});
</script>
