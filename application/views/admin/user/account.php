<?php $data['page_title'] = "Users View - Admin";
$data['style']='<style type = "text/css">
	.capitalize{
		text-transform:capitalize;
	}
	label.error{
		background:#F00;
		color:#EEE;
	}
</style>'; ?>
<?php $this->load->view('admin/includes/header.php',$data);?>
<div id="page-wrapper">
    <h1> Edit Account</h1>
    <div class="row">
    <div class="container col-lg-6 col-md-7 col-sm-9">
    <div class="panel panel-primary">
    	<div class="panel-heading">
    		Account
    	</div>
    	<div class="panel-body">
    		<?php if (isset($error)) echo '<div class="label label-danger">'.$error.'</div>';?>
    		<?php echo form_open("user/account",array("class"=>"form","id"=>"add-form"));?>		    	
	    		<div class="">
	                <div class="row">
	                	<div class="form-group col-lg-8 col-md-10">
	                    <label class="control-label" for="uname">Username</label>
	                    <div class="input-group">
	                    <span class="input-group-addon input-sm"><i class="fa fa-user"></i></span>
	                    <?php echo form_input(array("name"=>"uname","class"=>"form-control input-sm","placeholder"=>"Username","required"=>"","type"=>"text"),set_value("uname",isset($user->username)?$user->username:'')); ?>
	                    </div>
	                	<?php echo form_error('uname'); ?>
		            	</div>
	                </div>
	                <div class="row">
	                	 <div class="form-group col-lg-8 col-md-10">
	                    <label class="control-label" for="old_pass">Enter Old Password</label>
	                    <div class="input-group">
	                    <span class="input-group-addon input-sm"><i class="fa fa-lock"></i></span><?php echo form_password(array("name"=>"old_pass","class"=>"form-control input-sm","placeholder"=>"Password","required"=>"")); ?>
	                	
	                	</div>
	                	<?php echo form_error('old_pass'); ?>
		           		</div>
	                </div>
	                <div class="row">
	                	 <div class="form-group col-lg-8 col-md-10">
	                    <label class="control-label" for="pass">Password</label>
	                    <div class="input-group">
	                    <span class="input-group-addon input-sm"><i class="fa fa-lock"></i></span><?php echo form_password(array("name"=>"pass","id"=>"pass","class"=>"form-control input-sm","placeholder"=>"Password","required"=>"")); ?>
	                	
	                	</div>
	                	<span class="label label-info">Password should be at least 8 characters and a combination of uppercase,lowercase and number.</span>
                	
	                	<?php echo form_error('pass'); ?>
		           		</div>
	                </div>
	                <div class="row">
	                	<div class="form-group col-lg-8 col-md-10">
	                    <label class="control-label" for="pass">Confirm Password</label>
	                    <div class="input-group">
	                    <span class="input-group-addon input-sm"><i class="fa fa-lock"></i></span>
	                    <?php echo form_password(array("name"=>"cpass","class"=>"form-control input-sm","placeholder"=>"ConfirmPassword","required"=>"")); ?>
	                	</div>
	                	<?php echo form_error('cpass'); ?>
		            </div>
	                </div>
	    		</div>
	    		<div class="row">
	    		<div class="form-group col-md-8 col-lg-4">
	    			<?php echo form_submit(array("value"=>"Save","class"=>"form-control btn btn-primary")) ?>
	    		</div>		
	    		</div>    	
		    <?php echo form_close();?>
    	</div>
    </div>    	
    </div>
    </div>
    
</div>
<?php  $this->load->view('admin/includes/footer.php');?>
<script src = "<?php echo base_url()?>js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		
		$("#add-form").validate({
			rules: {  			             
	             old_pass:{
	            	minlength:8
	            },
	            pass:{
	            	minlength:8
	            },
	            cpass:{
	            	minlength:8,
	            	equalTo:"#pass"
	            }
	       },
	       messages:{
	       		old_pass:{
	       			minlength:"Password too short. Min of 8 characters."
				},
	       		pass:{
	       			minlength:"Password too short. Min of 8 characters."
				},
	       		cpass:{
	       			minlength:"Password too short. Min of 8 characters.",
	       			equalTo:"Password did not match."
	       		}
	       }
		});
	});
</script>