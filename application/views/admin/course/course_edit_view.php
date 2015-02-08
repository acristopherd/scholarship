<?php $page_title = "college View - Admin"; ?>
<?php include("/../includes/header.php");?>
<div id="page-wrapper">
    <h1> Course</h1>
    <div class="row">
    <div class="wrapper col-lg-6">
    <div class="panel panel-primary">
    	<div class="panel-heading">
    		Edit Course
    	</div>
    	<div class="panel-body">
    		<?php echo form_open("college/edit",array("class"=>"form"));?>		    	
	    		<div class="">
	    			<input type = "hidden" name = "id" value = "<?php echo (isset($courses))?$courses[0]->id:set_value("id")?>" />
	    			<div class="form-group">
	                    <label class="control-label" for="accronym">Course Accronym</label>
	                    <?php echo form_input(array("name"=>"accronym","class"=>"form-control input-sm","placeholder"=>"Accronym"),(isset($courses))?$courses[0]->course:set_value("accronym")); ?>
	                </div>
	                <div class="form-group">
	                    <label class="control-label" for="name">Course Name</label>
	                    <?php echo form_input(array("name"=>"name","class"=>"form-control input-sm","placeholder"=>"college Name"),(isset($courses))?$courses[0]->desc:set_value("name")); ?>
	                </div> 
	                <div class="form-group col-lg-8">
	                    <label class="control-label" for="name">College</label>
	                    <?php echo form_dropdown("college",$colleges,$courses[0]->coll_id,"class='form-control input-sm'");?>
	                	<?php echo form_error('college'); ?>
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
<?php include("/../includes/footer.php");
