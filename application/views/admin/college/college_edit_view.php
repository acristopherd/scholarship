<?php $data['page_title'] = "college View - Admin"; ?>
<?php  $this->load->view('admin/includes/header.php',$data);?>
<div id="page-wrapper">
    <h1> College</h1>
    <div class="row">
    <div class="wrapper col-lg-6">
    <div class="panel panel-primary">
    	<div class="panel-heading">
    		Edit College
    	</div>
    	<div class="panel-body">
    		<?php echo form_open("college/edit",array("class"=>"form"));?>		    	
	    		<div class="">
	    			<input type = "hidden" name = "id" value = "<?php echo (isset($colleges))?$colleges[0]->id:set_value("id")?>" />
	    			<div class="form-group">
	                    <label class="control-label" for="accronym">College Accronym</label>
	                    <?php echo form_input(array("name"=>"accronym","class"=>"form-control input-sm","placeholder"=>"Accronym"),(isset($colleges))?$colleges[0]->college:set_value("accronym")); ?>
	                </div>
	                <div class="form-group">
	                    <label class="control-label" for="name">College Name</label>
	                    <?php echo form_input(array("name"=>"name","class"=>"form-control input-sm","placeholder"=>"College Name"),(isset($colleges))?$colleges[0]->desc:set_value("name")); ?>
	                </div> 
	                <div class="form-group">
	                    <label class="control-label" for="dean">College Dean</label>
	                    <?php echo form_input(array("name"=>"dean","class"=>"form-control input-sm","placeholder"=>"College Dean"),(isset($colleges))?$colleges[0]->dean:set_value("name")); ?>
	                	<?php echo form_error('dean'); ?>
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
<?php  $this->load->view('admin/includes/footer.php');
