<?php 
$style = '<style type = "text/css">
	.card p{padding:0 1em}
	
</style>';
include("includes/header.php");?>
<div class="container main-container">
	
	<?php echo form_open("scholar/login",array('class'=>'form-signin'))?>
	<div class = "card card-default span4">
		<div class = "card-heading">
			<h3>Login</h3>
		</div>
		<div class = "card-body">
			<?php echo $this->session->flashdata("login_failed")?"<div class='alert alert-danger'>".$this->session->flashdata("login_failed")."</div>":"";?>
			<div class="form-group">
				<?php 
				echo form_label("Email:","email");
				echo form_input(array("class"=>"form-control input-sm","name"=>"email","placeholder"=>"Email","type"=>"email","required"=>"required"),set_value("email"));
				echo form_error("email");
				?>
			</div>
			<div class="form-group">
				<?php 
				echo form_label("Password:","password");
				echo form_input(array("class"=>"form-control input-sm","name"=>"password","placeholder"=>"Password","type"=>"password","required"=>"required"));
				echo form_error("password");
				?>
			</div>
			<div class="form-group">
				<?php echo form_submit(array("class"=>"btn btn-primary"),"Login")?>
			</div>
			
		</div>
		<div class = "card-footer">
			<p>
				No account yet? 
			</p>
			<p>
				Feel free to <?php echo anchor("scholar/signup","signup");?>.
			</p>			
		</div>
			
	</div>
	<?php echo form_close()?>
	
	
</div>
	
<?php include("includes/footer.php");?>