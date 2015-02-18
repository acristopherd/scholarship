<?php $this->load->view("includes/header.php");?>
<section class="container">
	<div class="row col-lg-4">
	<?php echo form_open("osa/grantee")?>
	<div class = "panel panel-default">
		<div class = "panel-heading">
			<h3>Login</h3>
		</div>
		<div class = "panel-body">
			<?php echo $this->session->flashdata("login_failed")?"<div class='alert alert-danger'>".$this->session->flashdata("login_failed")."</div>":"";?>
			<div class="form-input">
				<?php 
				echo form_label("Username:","uname");
				echo form_input(array("class"=>"form-control input-sm","name"=>"uname","placeholder"=>"Username","type"=>"text","required"=>"required"),set_value("uname"));
				echo form_error("uname");
				?>
			</div>
			<div class="form-input">
				<?php 
				echo form_label("Password:","password");
				echo form_input(array("class"=>"form-control input-sm","name"=>"password","placeholder"=>"Password","type"=>"password","required"=>"required"));
				echo form_error("password");
				?>
			</div>
		</div>
		<div class = "panel-footer">
			<?php echo form_submit(array("class"=>"btn btn-primary"),"Login")?>
			
		</div>
	</div>
	<?php echo form_close()?>
	</div>
	<div class="container">
		
	</div>
</section>
	
<?php $this->load->view("includes/footer.php");?>