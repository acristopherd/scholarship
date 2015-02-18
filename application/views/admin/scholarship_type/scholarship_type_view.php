<?php $page_title = "Scholarship Type View - Admin"; 
		$style ='<style type="text/css">.requirements{margin:.5em}input[type="text"]{text-transform:capitalize}</style>'?>
<?php $this->load->view('admin/includes/header.php');?>
<div id="page-wrapper">
    <h1>Types of Scholarship</h1>
    <div class="row">
    <div class="container col-lg-6">
    <div class="panel panel-primary">
    	<div class="panel-heading">
    		Add Scholarship
    	</div>
    	<div class="panel-body">
    		<?php echo form_open("scholarshiptype/add",array("class"=>"form"));?>		    	
	    		<div class="">
	                <div class="form-group">
	                    <label class="control-label" for="name">Scholarship Full Name</label>
	                    <?php echo form_input(array("name"=>"name","class"=>"form-control input-sm","placeholder"=>"Scholarship Name"),set_value("name")); ?>
	                	<?php echo form_error('name'); ?>
	                </div>
	                <div class="form-group col-lg-6 col-md-6">
	                    <label class="control-label" for="category">Category</label>
	                    <?php echo form_dropdown("category",array(""=>"Select","Academic"=>"Academic","Private"=>"Private"),set_value("category"),"class='form-control input-sm'"); ?>
	                	<?php echo form_error('min_ave'); ?>
	                </div> 
	                <div class="form-group col-lg-3 col-md-3">
	                    <label class="control-label" for="min_grade">Minimum Grade</label>
	                    <?php echo form_input(array("name"=>"min_grade","type"=>"number","step"=>".25","min"=>"0","max"=>"5.0","class"=>"form-control input-sm","placeholder"=>"Minimum Grade"),set_value("min_grade","0")); ?>
	                	<?php echo form_error('min_grade'); ?>
	                </div> 
	                <div class="form-group col-lg-3 col-md-3">
	                    <label class="control-label" for="min_ave">Average</label>
	                    <?php echo form_input(array("name"=>"min_ave","type"=>"number","step"=>".25","min"=>"0","max"=>"5.0","class"=>"form-control input-sm","placeholder"=>"Average"),set_value("min_ave","0")); ?>
	                	<?php echo form_error('min_ave'); ?>
	                </div> 
	                 <div class="form-group">
	                    <label class="control-label" for="requirements[]">Requirements</label>
	                    <?php echo form_input(array("name"=>"requirements[]","class"=>"form-control input-sm requirements","placeholder"=>"Requirement Name",set_value("name"))); ?>
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
    
    <div class = "row">    	
    	<h3 class="">List of Scholarships</h3>
    	<table class="table table-striped table-hover table-responsive">
    		<thead><tr class="table-header"><th>No</th><th>Category</th><th>Name</th><th>Min Grade</th><th>Average</th><th>Requirements</th><th>Edit</th></tr></thead>
    		<tbody>
    			<?php
    			$no=1;
    			foreach($types as $type){
    			?>
    			<tr><td><?php echo $no++?></td>	    				
    				<td><?php echo $type["info"]->category?></td>
    				<td><?php echo $type["info"]->type?></td>
    				<td><?php echo $type["info"]->minimum_grade?></td>
    				<td><?php echo $type["info"]->min_average?></td>
    				<td><?php foreach ($type["requirements"] as $requirement)echo "<span class='btn btn-default btn-sm btn-outline'>".$requirement->requ_name."</span>&nbsp;"?></td>
    				<td><?php echo anchor("scholarshiptype/edit/".$type['info']->id,"<i class='fa fa-edit'></i>") ?>&nbsp;<?php echo anchor("scholarshiptype/delete/".$type['info']->id."/".md5(mdate($type['info']->id."")),"<i class='fa fa-times'></i>",array("class"=>"btn-delete")) ?></td></tr>
    			<?php
    			}
				?>
    		</tbody>
    	</table>
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
<?php  $this->load->view('admin/includes/footer.php');
