<?php 
//$headscript="<script src='https://www.google.com/recaptcha/api.js'></script>";
$data['style']='<style type = "text/css">
	input[type="text"]{
		text-transform:capitalize;
	}
</style>';
$this->load->view("includes/header.php",$data); ?>
<section class = "container main-container">
	<h4>Account Settings</h4>
	<div class = "row">
		
		<div class="col-lg-6">
		
		<?php echo form_open("scholar/edit_personal",array("name"=>"signup","id"=>"signup"));?>
		
        
            <div class="tab-pane fade in active" id="basic-info">
                <div class = "panel panel-default">
				<div class="panel-heading">
					Personal Information
					
				</div>
				<div class = "panel-body">	
					<?php if(isset($error)) echo "<div class='alert alert-danger'>".$error."</div>";?>	
	                <div class="row">
	                    <div class="form-group col-lg-5">
	                        <label class="control-label" for="firstname">Firstname</label>
	                        <?php echo form_input(array("name"=>"firstname","class"=>"form-control input-sm disabled","placeholder"=>"First Name","required"=>"","disabled"=>"disabled"),set_value("firstname",isset($scholar[0]->fname)?$scholar[0]->fname:"")); ?>
	                    	<?php echo form_error('firstname'); ?>
	                    </div>                        
	                    <div class="form-group  col-lg-3">
	                        <label class="control-label" for="middlename">Middlename</label>
	                        <?php echo form_input(array("name"=>"middlename","class"=>"form-control input-sm disabled","placeholder"=>"Middle Name","disabled"=>"disabled"),set_value("middlename",isset($scholar[0]->mname)?$scholar[0]->mname:"")); ?>
	                    	<?php echo form_error('middlename'); ?>
	                    </div>
	                    <div class="form-group  col-lg-4">
	                        <label class="control-label" for="lastname">Lastname</label>
	                        <?php echo form_input(array("name"=>"lastname","class"=>"form-control input-sm disabled","placeholder"=>"Last Name","required"=>"","disabled"=>"disabled"),set_value("lastname",isset($scholar[0]->lname)?$scholar[0]->lname:"")); ?>
	                    	<?php echo form_error('lastname'); ?>
	                    </div>
	                </div>
	                <div class="row">
	                	<div class="form-group  col-lg-4">
	                        <label class="control-label" for="bdate">Birthdate</label>
	                        <?php echo form_input(array("type"=>"date","name"=>"bdate","class"=>"form-control input-sm disabled","placeholder"=>"Birthdate","required"=>"","disabled"=>"disabled"),set_value("bdate",isset($scholar[0]->birthdate)?$scholar[0]->birthdate:"")); ?>
	                		<?php echo form_error('bdate'); ?>
	                    </div>
	                	<div class="form-group  col-lg-4">
	                        <label class="control-label" for="sex">Sex</label>
	                        <?php echo form_dropdown("sex",array(""=>"-Select-","Male"=>"Male",'Female'=>"Female"),set_value("sex",isset($scholar[0]->gender)?$scholar[0]->gender:""),"class='form-control input-sm  disabled' required disabled"); ?>
	                		<?php echo form_error('sex'); ?>
	                    </div>
	                	<div class="form-group  col-lg-4">
	                        <label class="control-label" for="status">Civil Status</label>
	                        <?php echo form_dropdown("status",array(""=>"-Select-","Single"=>"Single","Maried"=>"Maried","Widowed"=>"Widowed","Separated"=>"Separated"),set_value("status",isset($scholar[0]->civil_status)?$scholar[0]->civil_status:""),"class='form-control input-sm disabled' disabled required"); ?>
	                		<?php echo form_error('status'); ?>
	                    </div>
	                </div>
	                <div class="row"> 
	                	<div class="form-group  col-lg-8">
	                        <label class="control-label" for="contact">Contact No.</label>
                        	<?php echo form_input(array("name"=>"contact","class"=>"form-control input-sm disabled","placeholder"=>"Contact No.","disabled"=>"disabled"),set_value("contact",isset($scholar[0]->contact_no)?$scholar[0]->contact_no:"")); ?>
                			<?php echo form_error('contact'); ?>
	                    </div>
	                </div>
	                <div class="row">                        
	                    <div class="form-group  col-lg-4">
	                        <label class="control-label" for="brgy">Barangay</label>
	                        <?php echo form_input(array("name"=>"brgy","class"=>"form-control input-sm disabled","placeholder"=>"Barangay","required"=>"","disabled"=>"disabled"),set_value("brgy",isset($scholar[0]->brgy)?$scholar[0]->brgy:"")); ?>
	                    	<?php echo form_error('brgy'); ?>
	                    </div>
	                    <div class="form-group  col-lg-4">
	                        <label class="control-label" for="town">Town</label>
	                        <?php echo form_input(array("name"=>"town","class"=>"form-control input-sm disabled","placeholder"=>"Town","required"=>"","disabled"=>"disabled"),set_value("town",isset($scholar[0]->town)?$scholar[0]->town:"")); ?>
	                    	<?php echo form_error('town'); ?>
	                    </div>
	                    <div class="form-group  col-lg-4">
	                        <label class="control-label" for="prov">Province</label>
	                        <?php echo form_input(array("name"=>"prov","class"=>"form-control input-sm disabled","placeholder"=>"Province","required"=>"","disabled"=>"disabled"),set_value("prov",isset($scholar[0]->prov)?$scholar[0]->prov:"")); ?>
	                    	<?php echo form_error('prov'); ?>
	                    </div>
	                    <div class="form-group password-row hidden">
		                    <label class="control-label" for="pass">Enter password to confirm.</label>
		                    <div class="input-group">
		                    <span class="input-group-addon input-sm"><i class="fa fa-lock"></i></span><?php echo form_password(array("name"=>"pass","class"=>"form-control input-sm","placeholder"=>"Password","required"=>"")); ?>
		                	
		                	</div>
		                	<?php echo form_error('pass'); ?>
			            </div>
	                </div>
                </div>
                <div class="panel-footer">
                <div ><?php echo form_button(array("value"=>"Edit","class"=>"btn btn-primary","id"=>"btn-edit","name"=>"btn-edit"),"Edit"); ?><?php echo form_submit(array("value"=>"Save","class"=>"btn btn-success btn-submit hidden","id"=>"btn-submit")); ?></div> 
                </div>
                </div>                                               
        	</div>
        
			
		<?php echo form_close(); ?>
		
	</div>
</section>
<script type="text/javascript">
	
</script>

<?php $this->load->view("includes/footer.php"); ?>
<script type="text/javascript">
$(document).ready(function(){
	$("#btn-edit").click(function(){
		$("input[disabled],select[disabled]").removeAttr("disabled");
		$(".hidden").removeClass("hidden");
		$(this).hide();
	});
});
</script>