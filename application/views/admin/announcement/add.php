<?php $page_title = "Announcement View - Admin"; 
$style='<link href="'.base_url().'css/htmlarea/jHtmlArea.css" rel="stylesheet">
		<style type = "text/css">
			input{
				text-transform:capitalize;
			}
		</style>'?>
<?php include("/../includes/header.php");?>
<div id="page-wrapper">
    <h1> Announcements</h1>
    <div class="row">
    <div class="wrapper col-lg-6 col-md-8">
    <div class="panel panel-primary">
    	<div class="panel-heading">
    		Add Announcement
    	</div>
    	<div class="panel-body">
    		<?php echo form_open("announcement/save",array("class"=>"form"));?>		    	
	    		<div class="">	    			
	    			<div class="form-group col-lg-8">
	                    <label class="control-label" for="a_title">Title</label>
	                    <?php echo form_input(array("name"=>"a_title","class"=>"form-control input-sm","placeholder"=>"Title"),set_value("a_title")); 
	                    		echo form_error("a_title");?>
	                </div>
	                <div class="form-group col-lg-8">
	                    <label class="control-label" for="a_date">Date</label>
	                    <?php echo form_input(array("name"=>"a_date","min"=>date("Y-m-d",mktime(0,0,0,date('m'),date('d')+1,date('Y'))),"class"=>"form-control input-sm","placeholder"=>"Date","type"=>"date"),set_value("a_date")); 
	                    		echo form_error("a_date");?>
	                </div>
	                <div class="form-group col-lg-8">
	                    <label class="control-label" for="a_time">Time</label>
	                    <?php echo form_input(array("name"=>"a_time","class"=>"form-control input-sm","placeholder"=>"Time","type"=>"time"),set_value("a_time")); 
	                    		echo form_error("a_time");?>
	                </div>
	                <div class="form-group col-lg-8">
	                    <label class="control-label" for="a_venue">Venue</label>
	                    <?php echo form_input(array("name"=>"a_venue","class"=>"form-control input-sm","placeholder"=>"Venue"),set_value("a_venue")); 
	                    		echo form_error("a_venue");?>
	                </div>
	                <div class="form-group col-lg-8">
	                    <label class="control-label" for="a_from">Announcement From</label>
	                    <?php echo form_input(array("name"=>"a_from","class"=>"form-control input-sm","placeholder"=>"Announcement From"),set_value("a_from")); 
	                    		echo form_error("a_from");?>
	                </div>
	                <div class="form-group col-lg-12">
	                    <label class="control-label" for="a_msg">Message</label>
	                    <?php echo form_textarea(array("name"=>"a_msg","id"=>"a_msg","class"=>"form-control input-sm","placeholder"=>"Message"),set_value("a_msg"));
								echo form_error("a_msg"); ?>
	                </div>
	                <div class="form-group col-lg-8">
	                    <label class="control-label" for="a_from">Share to:</label>
	                    <?php echo form_dropdown("share",array("0"=>"All","1"=>"Select"),null,'class="form-control input-sm" id="share"'); 
	                    		echo form_error("share");?>
	                </div>
	                <div class="form-group col-lg-8 hidden" id ="types">
	                    <?php foreach($types as $val=>$type){?>
	                    	<div class="checkbox"><label><input type = "checkbox" name = "types[]" value ="<?php echo $val?>" /><?php echo $type?></label></div>
	                    <?php } ?>
	                    
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
<?php include("/../includes/footer.php");
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
	$("#share").bind("change",function(){
		$(".hidden").removeClass("hidden");
	});
});
</script>