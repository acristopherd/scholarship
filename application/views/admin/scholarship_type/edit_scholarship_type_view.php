<?php $page_title = "Scholarship Type View - Admin"; 
		$style ='<style type="text/css">.requirements{margin:.5em}input[type="text"]{text-transform:capitalize}</style>'?>
<?php include("/../includes/header.php");?>
<div id="page-wrapper">
    <h1>Types of Scholarship</h1>
    <div class="row">
    <div class="container col-lg-6">
    <div class="panel panel-primary">
    	<div class="panel-heading">
    		Edit Scholarship Type
    	</div>
    	<div class="panel-body">
    		<?php echo form_open("scholarshiptype/edit",array("class"=>"form"));?>		    	
	    		<div class="">
	    			<?php echo form_hidden("id",isset($types[0]['info']->id)?$types[0]['info']->id:set_value("name"))?>
	                <div class="form-group">
	                    <label class="control-label" for="name">Scholarship Full Name</label>
	                    <?php echo form_input(array("name"=>"name","class"=>"form-control input-sm","placeholder"=>"Scholarship Name"),isset($types[0]['info']->type)?$types[0]['info']->type:set_value("name")); ?>
	                	<?php echo form_error('name'); ?>
	                </div> 
	                 <div class="form-group col-lg-6 col-md-6"">
	                    <label class="control-label" for="name">Minimum Grade</label>
	                    <?php echo form_input(array("name"=>"min_grade","type"=>"number","step"=>".25","min"=>"0","max"=>"5.0","class"=>"form-control input-sm","placeholder"=>"Minimum Grade"),set_value("min_grade",isset($types[0]['info']->minimum_grade)?$types[0]['info']->minimum_grade:'0')); ?>
	                	<?php echo form_error('min_grade'); ?>
	                </div> 
	                <div class="form-group col-lg-6 col-md-6">
	                    <label class="control-label" for="name">Minimum Average</label>
	                    <?php echo form_input(array("name"=>"min_ave","type"=>"number","step"=>".25","min"=>"0","max"=>"5.0","class"=>"form-control input-sm","placeholder"=>"Minimum Average"),set_value("min_ave",isset($types[0]['info']->average)?$types[0]['info']->average:'0')); ?>
	                	<?php echo form_error('min_ave'); ?>
	                </div> 
	                 <div class="form-group">
	                    <label class="control-label" for="requirements[]">Requirements</label>
	                    <?php 
	                    if(isset($types)){
	                    foreach($types[0]["requirements"] as $requirement){
	                    	//print_r($requirement);
	                    	echo form_input(array("name"=>"oldrequirements[]","class"=>"form-control input-sm requirements","placeholder"=>"Requirement Name","disabled"=>"disabled"),$requirement->requ_name); 
						}
						}
	                    ?>
	                    <?php echo form_input(array("name"=>"requirements[]","class"=>"form-control input-sm requirements","placeholder"=>"Requirement Name",set_value("requirements[]"))); ?>
	                	
	                	<?php echo form_error('requirements[]'); ?>
	                </div> 
	    		</div>
	    		<div class="row">
	    			<div class="form-group col-lg-3">
	    			<div class = "btn btn-primary" id="btn-add"><i class="fa fa-plus"></i></div>
	    			</div>
    			</div>  
	    		<div class="form-group col-md-8 col-lg-4">
	    			<?php echo form_submit(array("value"=>"Save","class"=>"form-control btn btn-primary")) ?>
	    		</div>		    
	    			
		    <?php echo form_close();?>
    	</div>
    </div>    	
    </div>
    </div>
</div>
<?php 
$script='
<script type = "text/javascript">
	$(document).ready(function(){
		$("#btn-add").bind("click",function(){
			newGradeRow = $(".requirements:last").clone();
			$(newGradeRow).val(null);
			$(".requirements:last").after(newGradeRow);			
			
			
		});		
	});
</script>';
?>
<?php include("/../includes/footer.php");
