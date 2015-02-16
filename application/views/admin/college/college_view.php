<?php $page_title = "college View - Admin"; ?>
<?php include("/../includes/header.php");?>
<div id="page-wrapper">
    <h1> Colleges</h1>
    <div class="row">
    <div class="container col-lg-6">
    <div class="panel panel-primary">
    	<div class="panel-heading">
    		Add college
    	</div>
    	<div class="panel-body">
    		<?php echo form_open("college/add",array("class"=>"form"));?>		    	
	    		<div class="">
	    			
	    			<div class="form-group">
	                    <label class="control-label" for="accronym">College Accronym</label>
	                    <?php echo form_input(array("name"=>"accronym","class"=>"form-control input-sm","placeholder"=>"Accronym"),set_value("accronym")); ?>
	                	<?php echo form_error('accronym'); ?>
	                </div>
	                <div class="form-group">
	                    <label class="control-label" for="name">College Name</label>
	                    <?php echo form_input(array("name"=>"name","class"=>"form-control input-sm","placeholder"=>"College Name"),set_value("name")); ?>
	                	<?php echo form_error('name'); ?>
	                </div> 
	                <div class="form-group">
	                    <label class="control-label" for="dean">College Dean</label>
	                    <?php echo form_input(array("name"=>"dean","class"=>"form-control input-sm","placeholder"=>"College Dean"),set_value("dean")); ?>
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
    
    <div class = "row">    	
    	<h3 class="">List of colleges</h3>
    	<table class="table table-striped table-hover table-responsive">
    		<thead><tr class="table-header"><th>No</th><th>Accronym</th><th>Name</th><th>Dean</th><th>Edit</th></tr></thead>
    		<tbody>
    			<?php
    			$no=1;
    			foreach($colleges as $college){
    			?>
    			<tr><td><?php echo $no++?></td><td><?php echo $college->college?></td><td><?php echo $college->desc?></td><td><?php echo $college->dean?></td><td><?php echo anchor("college/edit/".$college->id,"<i class='fa fa-edit'></i>") ?></td></tr>
    			<?php
    			}
				?>
    		</tbody>
    	</table>
    </div>
</div>
<?php include("/../includes/footer.php");
