<?php 
//$headscript="<script src='https://www.google.com/recaptcha/api.js'></script>";
$data['style']='<style type = "text/css">
	input[type="text"]{
		text-transform:capitalize;
	}
	.well-sm{
		background-color:#dde ;
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
		
		<?php echo form_open("scholar/edit_work",array("name"=>"signup","id"=>"signup"));?>
		
        <!-- Tab panes -->
        <div class = "card card-default">
				<div class="card-heading simple">
					<h3>Work</h3>
				</div>
				<div class = "card-body">
					<?php 
					 foreach($works as $work){?>
					<div class="work-info well well-sm">
					<span class="btn btn-danger btn-sm btn-delete pull-right"><i class = "fa fa-times"></i></span>
	                <div class="form-group">
	                    <label class="control-label" for="work">Work</label>
	                    <?php echo form_input(array("name"=>"work[]","class"=>"form-control input-sm","placeholder"=>"Work","required"=>""),set_value("work",isset($work->work)?$work->work:"")); ?>
	                	
		            </div>
	                <div class="form-group">
	                    <label class="control-label" for="work_addr">Company</label>
	                    <?php echo form_input(array("name"=>"company[]","class"=>"form-control input-sm","placeholder"=>"Company","required"=>""),set_value("company",isset($work->workplace)?$work->workplace:"")); ?>
	                	
		            </div>
		            <div class="form-group">
	                    <label class="control-label" for="work_addr">Date Inclusive</label>
	                    <?php echo form_input(array("name"=>"date_inclusive[]","class"=>"form-control input-sm","placeholder"=>"Date Inclusive","required"=>""),set_value("date_inclusive",isset($work->date_inclusive)?$work->date_inclusive:"")); ?>
	                
		            </div>
		            
		            </div>
					<?php }
					if(count($works)<=0){
						?>
					<div class="work-info well well-sm">
					<span class="btn btn-danger btn-sm btn-delete pull-right"><i class = "fa fa-times"></i></span>
	                <div class="form-group">
	                    <label class="control-label" for="work">Work</label>
	                    <?php echo form_input(array("name"=>"work[]","class"=>"form-control input-sm","placeholder"=>"Work","required"=>""),set_value("work",isset($scholar[0]->work)?$scholar[0]->work:"")); ?>
	                	<?php echo form_error('work'); ?>
		            </div>
	                <div class="form-group">
	                    <label class="control-label" for="work_addr">Company</label>
	                    <?php echo form_input(array("name"=>"company[]","class"=>"form-control input-sm","placeholder"=>"Company","required"=>""),set_value("company",isset($scholar[0]->workplace)?$scholar[0]->workplace:"")); ?>
	                	<?php echo form_error('company'); ?>
		            </div>
		            <div class="form-group">
	                    <label class="control-label" for="work_addr">Date Inclusive</label>
	                    <?php echo form_input(array("name"=>"date_inclusive[]","class"=>"form-control input-sm","placeholder"=>"Date Inclusive","required"=>""),set_value("date_inclusive",isset($scholar[0]->date_inclusive)?$scholar[0]->date_inclusive:"")); ?>
	                	<?php echo form_error('date_inclusive'); ?>
		            </div>
		            
		            </div>
		            <?php
		            }
					?>
		             <div class="row">
		    			<div class="form-group span3">
		    			<div class = "btn btn-primary" id="btn-add"><i class="fa fa-plus"></i></div>
		    			</div>
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
	            	<div ><?php echo form_button(array("value"=>"Save","class"=>"btn btn-primary","id"=>"btn-edit","name"=>"btn-edit"),"Save"); ?><?php echo form_submit(array("value"=>"Continue","class"=>"btn btn-success btn-submit hidden","id"=>"btn-submit")); ?></div> 
                	
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
		
		$(".btn-delete").click(function(){
			$(this).parent().remove();
		});
		
		$("#btn-add").bind("click",function(){
			
			newWorkRow = $(".work-info:last").clone();
			$(".work-info:last").after(newWorkRow);
			//$(newWorkRow).find("label").remove();
			$(newWorkRow).find("input").each(function(){
				$(this).val(null);
			});
			
		});
		
	});
</script>