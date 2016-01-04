<?php $data['page_title'] = "Scholar View - Admin"; 
$data['style'] = '<style type = "text/css">
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
<?php $this->load->view('admin/includes/header.php',$data); ?>
<div id="page-wrapper">
    <h1> Scholars</h1>
    <div class="container-fluid">
    	<div class="col-sm-6">
    	<div class="panel panel-primary">
    		<div class="panel-heading">
    			Sem and S.Y.
    		</div>
    		<div class="panel-body">
    			<div class="form-group">
    				<?php echo form_label("S.Y.:","sy",array("class"=>"control-label")); 
    				echo form_dropdown("sy",$sys,null,"class='form-control' id ='sy'")?>
    			</div>
    			<div class="form-group">
    				<?php echo form_label("Sem:","sem",array("class"=>"control-label"));
					 echo form_dropdown("sem",$sems,null,"class='form-control' id = 'sem'")?>
				</div>
		    	
    		</div>
    	</div>  
    	<?php echo form_open("scholar/print_scholar_college",array("class"=>"form-inline","role"=>"form","method"=>"get"));?>
    	<div class="panel panel-primary">
    		<div class="panel-heading">
    			College
    		</div>
    		<div class="panel-body">
    			<input type = "hidden" name = "sem" class= "sem" />
    			<input type = "hidden" name = "sy" class= "sy" />
    			<div class="form-group pad-em-1"><?php echo form_label("Choose College:","college",array("class"=>"control-label")); echo form_dropdown("college",$colleges,null,"class='form-control'")?></div>
    		</div>
    		<div class="panel-footer">
    			<div>
		    	<?php echo form_submit(array("class"=>"btn btn-primary btn-print","id"=>"btn-apply"),"Print Scholars");?>
		    	</div>
    		</div>
    	</div>  
    	<?php echo form_close(); ?>
    	<?php echo form_open("scholar/print_scholar_course",array("class"=>"form-inline","role"=>"form","method"=>"get"));?>    			
    	<div class="panel panel-primary">
    		<div class="panel-heading">
    			Course
    		</div>
    		<div class="panel-body">
    			<input type = "hidden" name = "sem" class= "sem" />
    			<input type = "hidden" name = "sy" class= "sy" />
    			<div class="form-group pad-em-1"><?php echo form_label("Choose Course:","course",array("class"=>"control-label")); 
    			echo form_dropdown("course",$courses,null,"class='form-control'")?></div>
		    	
		    	
    		</div>
    		<div class="panel-footer">
    			<div>
		    	<?php echo form_submit(array("class"=>"btn btn-primary btn-print","id"=>"btn-apply"),"Print Scholars");?>
		    	</div>
    		</div>
    	</div>   
    	<?php echo form_close(); ?>
    	<?php echo form_open("scholar/print_scholar_type",array("class"=>"form-inline","role"=>"form","method"=>"get"));?>
    	<div class="panel panel-primary">
    		<div class="panel-heading">
    			Scholarship Type
    		</div>
    		<div class="panel-body">
    			
    			<input type = "hidden" name = "sem" class= "sem" />
    			<input type = "hidden" name = "sy" class= "sy" />
    			<div class="form-group pad-em-1"><?php echo form_label("Choose Type:","course",array("class"=>"control-label")); 
    			echo form_dropdown("type",$types,null,"class='form-control'")?></div>
		    	
		    	
    		</div>
    		<div class="panel-footer">
    			<div>
		    	<?php echo form_submit(array("class"=>"btn btn-primary btn-print","id"=>"btn-apply"),"Print Scholars");?>
		    	</div>
    		</div>
    	</div>  
    	<?php echo form_close(); ?>  	
    </div>
	</div>
</div>
<?php  $this->load->view('admin/includes/footer.php');?>
 <script src="<?php echo base_url();?>js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url();?>js/plugins/dataTables/dataTables.bootstrap.js"></script>

   
    <script>
    $(document).ready(function() {
        
         $('[data-toggle="tooltip"]').tooltip();  
         $('#sem').bind("change",function(){
         	$('.sem').val($(this).val());
         });
         
         $('#sy').bind("change",function(){
         	$('.sy').val($(this).val());
         });
         
         $(".btn-print-grade").click(function(e){
         	var w = window.open($(this).attr("href"),"Print Window","height=1000,width=1000,menubar=0,location=0");
         	e.preventDefault();
         });
         
       
    	var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=300,left = 312,top = 234');
   
         $("form").each(function(){
         	$(this).target='Popup_Window';
         });
    });
    </script>
