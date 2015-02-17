<?php $page_title = "Scholar View - Admin"; 
$style = '<style type = "text/css">
			.requirement{
				max-width:8em;
				text-overflow:ellipsis;
				overflow:hidden;
			}
			.pad-em-1{
				padding-bottom:1em;
				padding-left:1em;
			}
			</style>'?>
<?php include("/../includes/header.php"); ?>
<div id="page-wrapper">
    <h1> Scholars</h1>
    <div class="row">
    	<div class="panel panel-primary">
    		<div class="panel-heading">
    			College
    		</div>
    		<div class="panel-body">
    			<?php echo form_open("scholar/print_scholar_college",array("class"=>"form-inline","role"=>"form","method"=>"get"));?>
    			<div class="form-group pad-em-1"><?php echo form_label("Choose College:","college",array("class"=>"control-label")); echo form_dropdown("college",$colleges,null,"class='form-control'")?></div>
		    	<div>
		    	<?php echo form_submit(array("class"=>"btn btn-primary btn-print","id"=>"btn-apply"),"Print Scholars");?>
		    	</div>
		    	<?php echo form_close(); ?>
    		</div>
    	</div>  
    	<div class="panel panel-primary">
    		<div class="panel-heading">
    			Course
    		</div>
    		<div class="panel-body">
    			<?php echo form_open("scholar/print_scholar_course",array("class"=>"form-inline","role"=>"form","method"=>"get"));?>
    			<div class="form-group pad-em-1"><?php echo form_label("Choose Course:","course",array("class"=>"control-label")); 
    			echo form_dropdown("course",$courses,null,"class='form-control'")?></div>
		    	<div>
		    	<?php echo form_submit(array("class"=>"btn btn-primary btn-print","id"=>"btn-apply"),"Print Scholars");?>
		    	</div>
		    	<?php echo form_close(); ?>
    		</div>
    	</div>   
    	<div class="panel panel-primary">
    		<div class="panel-heading">
    			Scholarship Type
    		</div>
    		<div class="panel-body">
    			<?php echo form_open("scholar/print_scholar_type",array("class"=>"form-inline","role"=>"form","method"=>"get"));?>
    			<div class="form-group pad-em-1"><?php echo form_label("Choose Type:","course",array("class"=>"control-label")); 
    			echo form_dropdown("type",$types,null,"class='form-control'")?></div>
		    	<div>
		    	<?php echo form_submit(array("class"=>"btn btn-primary btn-print","id"=>"btn-apply"),"Print Scholars");?>
		    	</div>
		    	<?php echo form_close(); ?>
    		</div>
    	</div>    	
    </div>

</div>
<?php include("/../includes/footer.php");?>
 <script src="<?php echo base_url();?>js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url();?>js/plugins/dataTables/dataTables.bootstrap.js"></script>

   
    <script>
    $(document).ready(function() {
        $('#scholars-table').dataTable();
         $('[data-toggle="tooltip"]').tooltip();  
         $("#check-all").click(function(){
         	$(".chk-approv").attr("checked","checked");
         });
         
         $(".btn-print-grade").click(function(e){
         	var w = window.open($(this).attr("href"),"Print Window","height=1000,width=1000,menubar=0,location=0");
         	e.preventDefault();
         });
    });
    </script>
