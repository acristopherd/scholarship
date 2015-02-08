<?php 
$style = '<style type = "text/css">
	.panel p{padding:0 1em}
</style>';
include("includes/header.php");?>
<section class="container main-container">
	<div class="row col-lg-4">
	<?php echo form_open("scholar/login")?>
	<div class = "panel panel-default">
		<div class = "panel-heading">
			<h3>Login</h3>
		</div>
		<div class = "panel-body">
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
		<div class = "panel-footer">
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
	<div class="container">
		
	</div>
</section>
	
<?php include("includes/footer.php");?>