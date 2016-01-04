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
		
		<?php echo form_open("scholar/edit_account",array("name"=>"signup","id"=>"signup"));?>
		
        <!-- Tab panes -->
        <div class = "card ">
				<div class="card-heading simple">
					<h3 class="">Account Information</h3>
				</div>
				<div class = "card-body">
					 <div class="form-group">
	                    <label class="control-label" for="email">Email</label>
	                    <div class="input-group input-prepend">
	                    <span class="add-on input-sm">@</span>
	                    <?php echo form_input(array("name"=>"email","class"=>"form-control input-sm","placeholder"=>"Email","required"=>"","type"=>"email"),set_value("email",isset($scholar[0]->email)?$scholar[0]->email:"")); ?>
	                    </div>
	                	<?php echo form_error('email'); ?>
		            </div>
	                <div class="form-group">
	                    <label class="control-label" for="pass">New Password</label>
	                    <div class="input-prepend">
	                    <span class="add-on input-sm"><i class="fa fa-lock"></i></span><?php echo form_password(array("name"=>"new_pass","class"=>"form-control input-sm","placeholder"=>"New Password","required"=>"")); ?>
	                	</div>
	                	<?php echo form_error('new_pass'); ?>
		            </div>
	                <div class="form-group">
	                    <label class="control-label" for="pass">Confirm New Password</label>
	                    <div class="input-prepend">
	                    <span class="add-on input-sm"><i class="fa fa-lock"></i></span><?php echo form_password(array("name"=>"cnew_pass","class"=>"form-control input-sm","placeholder"=>"Confirm New Password","required"=>"")); ?>
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
	            <div class="card-actions">
	            	<div ><?php echo form_submit(array("value"=>"Save","class"=>"btn btn-success btn-submit","id"=>"btn-submit")); ?></div> 
                	
	            </div>
	            </div>
			
		<?php echo form_close(); ?>
		
	</div>
</div>
<script type="text/javascript">
	
</script>

<?php 

$this->load->view("includes/footer.php"); ?>