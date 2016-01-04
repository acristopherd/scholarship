<?php include("includes/header.php"); ?>

<div class="row">&nbsp;</div>
<section class = "container main-container span6 offset3">
	<?php if (isset($email_sent)){
	?>
	<div class = "row">
			<h3>Hello <?php echo $this->session->userdata("fname")?></h3>
			<?php if($this->session->flashdata("message")) echo $this->session->flashdata("message")  ?>
			<p><?php echo $email_sent?></p>
		</div>
	<?php
	}
	else {
	?>
		<div class = "container-fluid span8">
			<div class = "row">
				<h3>Hello <?php echo $this->session->userdata("fname")?></h3>
				<?php if($this->session->flashdata("message")) echo $this->session->flashdata("message")  ?>
			</div>
			<div class="row">
			<?php echo form_open("scholar/send_verify","id='send_verify'");?>
			<div id="email-box">
				<div class="form-group">
		            <label class="control-label" for="email">Email</label>
		            <div class="input-prepend">
		            <span class="add-on input-sm">@</span>
		            <?php echo form_input(array("name"=>"email","class"=>"form-control input-sm contact","placeholder"=>"Your Email"),$this->session->userdata("email")); ?>
		            </div>
		        	<?php echo form_error('email'); ?>
		        </div>
		        <?php echo form_submit("","Send Verification","class='btn btn-success'");?>
			</div>
			</div>
		</div>
	<?php
	}
	?>
	
	
	
</section>
<div class="row">&nbsp;</div>

<?php include("includes/footer.php"); ?>