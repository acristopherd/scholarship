<?php 
//$headscript="<script src='https://www.google.com/recaptcha/api.js'></script>";
$data['style']='<style type = "text/css">
	input[type="text"]{
		text-transform:capitalize;
	}
</style>';
$this->load->view("includes/header.php",$data); ?>
<header class="" id = "overview">
	<div class="container main-header">
		<h1 class="h1">Account Settings</h1>
	</div>
</header>
<div class = "container main-container">
	<div class = "row">
		
		<div class="span6">
		
		<?php echo form_open("scholar/edit_educ",array("name"=>"signup","id"=>"signup"));?>
		
        <!-- Tab panes -->
        <div class = "card card-default">
				<div class="card-heading simple">
					<h3>Educational Background</h3>
				</div>
				<div class = "card-body">
	                <div class="form-group">
	                    <label class="control-label" for="school_grad">School Graduated</label>
	                    <?php echo form_input(array("name"=>"school_grad","class"=>"form-control input-sm","placeholder"=>"School Graduated","required"=>"","disabled"=>"disabled"),set_value("school_grad",isset($scholar[0]->school_grad)?$scholar[0]->school_grad:"")); ?>
	                	<?php echo form_error('school_grad'); ?>
		            </div>
	                <div class="form-group">
	                    <label class="control-label" for="school_addr">School Address</label>
	                    <?php echo form_input(array("name"=>"school_addr","class"=>"form-control input-sm","placeholder"=>"Address of school where you graduated.","required"=>"","disabled"=>"disabled"),set_value("school_addr",isset($scholar[0]->addr_school)?$scholar[0]->addr_school:"")); ?>
	                	<?php echo form_error('school_addr'); ?>
		            </div>
	                <div class="form-group password-row hidden wrapper">
	                    <label class="control-label" for="pass">Enter password to confirm.</label>
	                    <div class="input-prepend">
	                    <span class="add-on input-sm"><i class="fa fa-lock"></i></span><?php echo form_password(array("name"=>"pass","class"=>"form-control input-sm","placeholder"=>"Password","required"=>"")); ?>
	                	
	                	</div>
	                	<?php echo form_error('pass'); ?>
		            </div>
	            </div>
	            <div class="card-actions">
	            	<div ><?php echo form_button(array("value"=>"Edit","class"=>"btn btn-primary","id"=>"btn-edit","name"=>"btn-edit"),"Edit"); ?><?php echo form_submit(array("value"=>"Save","class"=>"btn btn-success btn-submit hidden","id"=>"btn-submit")); ?></div> 
                	
	            </div>
	            </div>
			
		<?php echo form_close(); ?>
		
	</div>
</div>
<script type="text/javascript">
	
</script>

<?php 
$this->load->view("includes/footer.php"); ?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#btn-edit").click(function(){
			$("input[disabled],select[disabled]").removeAttr("disabled");
			$(".hidden").removeClass("hidden");
			$(this).hide();
		});
	});
</script>