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
		
		<?php echo form_open("scholar/edit_family",array("name"=>"signup","id"=>"signup"));?>
		
        <!-- Tab panes -->
        <div class = "panel panel-default">
				<div class="panel-heading">
					Family Background
				</div>
				<div class = "panel-body">
	                <div class="row">
	                    <div class="form-group col-lg-10">
	                        <label class="control-label" for="father">Father</label>
	                        <?php echo form_input(array("name"=>"father","class"=>"form-control input-sm","placeholder"=>"Father's Name","disabled"=>"disabled"),set_value("father",isset($scholar[0]->fa_name)?$scholar[0]->fa_name:"")); ?>
	                    	<?php echo form_error('father'); ?>
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="form-group col-lg-6">
	                        <label class="control-label" for="father_occu">Occupation</label>
	                        <?php echo form_input(array("name"=>"father_occu","class"=>"form-control input-sm","placeholder"=>"Occupation","disabled"=>"disabled"),set_value("father_occu",isset($scholar[0]->fa_occup)?$scholar[0]->fa_occup:"")); ?>
	                    	<?php echo form_error('father_occu'); ?>
	                    </div>
	                    <div class="form-group col-lg-6">
	                        <label class="control-label" for="father_educ">Father Educational Attainment</label>
	                        <?php echo form_input(array("name"=>"father_educ","class"=>"form-control input-sm input-right","placeholder"=>"Educational Attainment","disabled"=>"disabled"),set_value("father_educ",isset($scholar[0]->fa_educ)?$scholar[0]->fa_educ:"")); ?>
	                   	<?php echo form_error('father_educ'); ?>
	                     </div>
	                </div>
	                <div class="row">
	                    <div class="form-group col-lg-10">
	                        <label class="control-label" for="mother">Mother</label>
	                        <?php echo form_input(array("name"=>"mother","class"=>"form-control input-sm","placeholder"=>"Mother's Name","disabled"=>"disabled"),set_value("mother",isset($scholar[0]->mo_name)?$scholar[0]->mo_name:"")); ?>
	                    	<?php echo form_error('mother'); ?>
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="form-group col-lg-6">
	                        <label class="control-label" for="mother_occu">Occupation</label>
	                        <?php echo form_input(array("name"=>"mother_occu","class"=>"form-control input-sm","placeholder"=>"Occupation","disabled"=>"disabled"),set_value("mother_occu",isset($scholar[0]->mo_occup)?$scholar[0]->mo_occup:"")); ?>
	                    	<?php echo form_error('mother_occu'); ?>
	                    </div>
	                    <div class="form-group col-lg-6">
	                        <label class="control-label" for="mother_educ">Mother Educational Attainment</label>
	                        <?php echo form_input(array("name"=>"mother_educ","class"=>"form-control input-sm","placeholder"=>"Educational Attainment","disabled"=>"disabled"),set_value("mother_educ",isset($scholar[0]->mo_educ)?$scholar[0]->mo_educ:"")); ?>
	                    	<?php echo form_error('mother_educ'); ?>
	                    </div>
	                </div>
                	<div class="form-group ">	                  
                		 
                		<label class="control-label" for="income">Combined Monthly Income</label>  
                		<div class="input-group col-lg-8">  	
                        <span class="input-group-addon">Php</span>
                        <?php echo form_input(array("type"=>"number","min"=>"0","name"=>"income","class"=>"form-control","placeholder"=>"Combined Monthly Income","required"=>"","disabled"=>"disabled"),set_value("income",isset($scholar[0]->com_mon_inc)?$scholar[0]->com_mon_inc:"")); ?>
                        <span class="input-group-addon">.00</span>
                        </div>
                        <?php echo form_error('income'); ?>
	                    
                    </div>
                    <div class="form-group col-lg-4">
                        <label class="control-label" for="no_of_children">No of Children</label>
                        <?php echo form_input(array("type"=>"number","min"=>"1","name"=>"no_of_children","class"=>"form-control input-sm","placeholder"=>"No of Children in the family","required"=>"","disabled"=>"disabled"),set_value("no_of_children",isset($scholar[0]->no_of_chil)?$scholar[0]->no_of_chil:"")); ?>
                    	<?php echo form_error('no_of_children'); ?>
	                </div>
	                <div class="form-group password-row hidden wrapper">
	                    <label class="control-label" for="pass">Enter password to confirm.</label>
	                    <div class="input-group">
	                    <span class="input-group-addon input-sm"><i class="fa fa-lock"></i></span><?php echo form_password(array("name"=>"pass","class"=>"form-control input-sm","placeholder"=>"Password","required"=>"")); ?>
	                	
	                	</div>
	                	<?php echo form_error('pass'); ?>
		            </div>
	            </div>
	            <div class="panel-footer">
	            	<div ><?php echo form_button(array("value"=>"Edit","class"=>"btn btn-primary","id"=>"btn-edit","name"=>"btn-edit"),"Edit"); ?><?php echo form_submit(array("value"=>"Save","class"=>"btn btn-success btn-submit hidden","id"=>"btn-submit")); ?></div> 
                	
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