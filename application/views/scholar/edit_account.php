<?php 
//$headscript="<script src='https://www.google.com/recaptcha/api.js'></script>";
$style='<style type = "text/css">
	input[type="text"]{
		text-transform:capitalize;
	}
</style>';
$this->load->view("includes/header.php"); ?>
<section class = "container main-container">
	<h4>Account Settings</h4>
	<div class = "row">
		
		<div class="col-lg-6">
		
		<?php echo form_open("scholar/edit_account",array("name"=>"signup","id"=>"signup"));?>
		
        <!-- Tab panes -->
        <div class = "panel panel-default">
				<div class="panel-heading">
					Account Information
				</div>
				<div class = "panel-body">
					 <div class="form-group">
	                    <label class="control-label" for="email">Email</label>
	                    <div class="input-group">
	                    <span class="input-group-addon input-sm">@</span>
	                    <?php echo form_input(array("name"=>"email","class"=>"form-control input-sm","placeholder"=>"Email","required"=>"","type"=>"email"),set_value("email",isset($scholar[0]->email)?$scholar[0]->email:"")); ?>
	                    </div>
	                	<?php echo form_error('email'); ?>
		            </div>
	                <div class="form-group">
	                    <label class="control-label" for="pass">New Password</label>
	                    <div class="input-group">
	                    <span class="input-group-addon input-sm"><i class="fa fa-lock"></i></span><?php echo form_password(array("name"=>"new_pass","class"=>"form-control input-sm","placeholder"=>"New Password","required"=>"")); ?>
	                	</div>
	                	<?php echo form_error('new_pass'); ?>
		            </div>
	                <div class="form-group">
	                    <label class="control-label" for="pass">Confirm New Password</label>
	                    <div class="input-group">
	                    <span class="input-group-addon input-sm"><i class="fa fa-lock"></i></span><?php echo form_password(array("name"=>"cnew_pass","class"=>"form-control input-sm","placeholder"=>"Confirm New Password","required"=>"")); ?>
	                	</div>
	                	<?php echo form_error('cnew_pass'); ?>
		            </div>
	                <div class="form-group password-row hidden wrapper">
	                    <label class="control-label" for="pass">Enter old password to confirm.</label>
	                    <div class="input-group">
	                    <span class="input-group-addon input-sm"><i class="fa fa-lock"></i></span><?php echo form_password(array("name"=>"pass","class"=>"form-control input-sm","placeholder"=>"Password","required"=>"")); ?>
	                	
	                	</div>
	                	<?php echo form_error('pass'); ?>
		            </div>
	            </div>
	            <div class="panel-footer">
	            	<div ><?php echo form_submit(array("value"=>"Save","class"=>"btn btn-success btn-submit","id"=>"btn-submit")); ?></div> 
                	
	            </div>
	            </div>
			
		<?php echo form_close(); ?>
		
	</div>
</section>
<script type="text/javascript">
	
</script>

<?php 
$script='<script type="text/javascript">
$(document).ready(function(){
	
});
		</script>';
$this->load->view("includes/footer.php"); ?>