<?php $page_title = "Announcement View - Admin"; 
$style='<link href="'.base_url().'css/htmlarea/jHtmlArea.css" rel="stylesheet">
		<style type = "text/css">
			input{
				text-transform:capitalize;
			}
		</style>'?>
<?php $this->load->view('admin/includes/header.php');?>
<div id="page-wrapper">
    <h1> News</h1>
    <div class="row">
    <div class="wrapper col-lg-6">
    <div class="panel panel-primary">
    	<div class="panel-heading">
    		Add News
    	</div>
    	<div class="panel-body">
    		<?php echo form_open_multipart("news/save",array("class"=>"form"));?>		    	
	    		<div class="">	    			
	    			<div class="form-group col-lg-8">
	                    <label class="control-label" for="a_title">Title</label>
	                    <?php echo form_input(array("name"=>"a_title","class"=>"form-control input-sm","placeholder"=>"Title"),set_value("a_title")); 
	                    		echo form_error("a_title");?>
	                </div>
	                <div class="form-group col-lg-8">
	                    <label class="control-label" for="a_date">Date</label>
	                    <?php echo form_input(array("name"=>"a_date","class"=>"form-control input-sm","placeholder"=>"Date","type"=>"date"),set_value("a_date")); 
	                    		echo form_error("a_date");?>
	                </div>
	                <div class="form-group col-lg-8">
	                    <label class="control-label" for="a_from">Author</label>
	                    <?php echo form_input(array("name"=>"a_from","class"=>"form-control input-sm","placeholder"=>"Author"),set_value("a_from")); 
	                    		echo form_error("a_from");?>
	                </div>
	                <div class="form-group col-lg-12">
	                    <label class="control-label" for="a_msg">Content</label>
	                    <?php echo form_textarea(array("name"=>"a_msg","id"=>"a_msg","class"=>"form-control input-sm","placeholder"=>"Content"),set_value("a_msg"));
								echo form_error("a_msg"); ?>
	                </div>
	                <div class="form-group col-lg-12">
	                    <label class="control-label" for="pics[]">Pictures</label>
	                    <?php echo form_input(array("name"=>"pics[]","type"=>"file","class"=>"form-control input-sm","placeholder"=>"Pictures","multiple"=>"","accept"=>"image/*"));
								echo form_error("a_msg"); ?>
	                </div>
	    		</div>
	    		<div class="form-group col-md-8 col-lg-4">
	    			<?php echo form_submit(array("value"=>"Save","class"=>"form-control btn btn-primary")) ?>
	    		</div>		    
	    		
		    <?php echo form_close();?>
    	</div>
    </div>    	
    </div>
    </div>
    
    
</div>
<?php  $this->load->view('admin/includes/footer.php');
?>
<script src="<?php echo base_url();?>js/htmlarea/jHtmlArea-0.8.min.js"></script>
<script type="text/javascript">
	$(function(){
		$('#a_msg').htmlarea({
		toolbar: [
		        ["bold", "italic", "underline","strikethrough","|","subscript","superscript"],
		        ["orderedList","unorderedList"],
		        ["indent","outdent"],
		        ["justifyleft","justifycenter","justifyright"],
		        ["link", "unlink"]
		    ]
		});
	
});
</script>