<?php $data['page_title'] = "course View - Admin"; ?>
<?php  $this->load->view('admin/includes/header.php',$data);?>
<div id="page-wrapper">
    <h1> Courses</h1>
    <hr>
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-home"></i> <?php echo anchor("admin/","Home")?>
        </li>
        <li class="active">Courses</li>
    </ol>
    <div class="container-fluid">
    <div class="container col-lg-6">
    <div class="panel panel-primary">
    	<div class="panel-heading">
    		Add Course
    	</div>
    	<div class="panel-body">
    		<?php echo form_open("course/add",array("class"=>"form"));?>		    	
	    		<div class="">
	    			
	    			<div class="form-group">
	                    <label class="control-label" for="accronym">Course Acronym</label>
	                    <?php echo form_input(array("name"=>"accronym","class"=>"form-control input-sm","placeholder"=>"Acronym"),set_value("accronym")); ?>
	                	<?php echo form_error('accronym'); ?>
	                </div>
	                <div class="form-group">
	                    <label class="control-label" for="name">Course Name</label>
	                    <?php echo form_input(array("name"=>"name","class"=>"form-control input-sm","placeholder"=>"course Name"),set_value("name")); ?>
	                	<?php echo form_error('name'); ?>
	                </div> 
	                <div class="form-group col-lg-8">
	                    <label class="control-label" for="name">College</label>
	                    <?php echo form_dropdown("college",$colleges,null,"class='form-control input-sm'");?>
	                	<?php echo form_error('college'); ?>
	                </div> 
	    		</div>
	    		<div class="form-group col-md-8 col-lg-5">
	    			<?php echo form_submit(array("value"=>"Save","class"=>"form-control btn btn-primary")) ?>
	    		</div>		    	
		    <?php echo form_close();?>
    	</div>
    </div>    	
    </div>
    </div>
    
    <div class = "container-fluid">    	
    	<h3 class="">List of Courses</h3>
    	<table class="table table-striped table-hover table-responsive">
    		<thead><tr class="table-header"><th>No</th><th>Acronym</th><th>Name</th><th>College</th><th>Edit</th></tr></thead>
    		<tbody>
    			<?php
    			$no=1;
    			foreach($courses as $course){
    			?>
    			<tr><td><?php echo $no++?></td><td><?php echo $course->course?></td><td><?php echo $course->desc?></td><td><?php echo $course->college?></td><td><?php echo anchor("course/edit/".$course->id,"<i class='fa fa-edit'></i>") ?></td></tr>
    			<?php
    			}
				?>
    		</tbody>
    	</table>
    </div>
</div>
<?php  $this->load->view('admin/includes/footer.php');?>
<script src="<?php echo base_url();?>js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url();?>js/plugins/dataTables/dataTables.bootstrap.js"></script>

   
    <script>
    $(document).ready(function() {
        $('table').dataTable();
         $('[data-toggle="tooltip"]').tooltip();  
         
    });
    </script>


