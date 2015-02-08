<?php $page_title = "Grade - Admin"; 
$style = '
<style type = "text/css">
	input[type="text"]{
		text-transform:capitalize;
	}
</style>
';?>
<?php include("/../includes/header.php");?>
<div id="page-wrapper">
    <h1> Scholars</h1>
    <div class="row">
    <div class="container col-lg-11">
    <div class="panel panel-primary">
    	<div class="panel-heading">
    		Compute Grades
    	</div>
    	<div class="panel-body">
    		<?php echo form_open("scholar/compute_grade",array("class"=>"form"));?>		
    			<input name="stud_id" id="stud_id" value ="<?php echo $this->uri->segment(3)?>" type="hidden" />  
    			
    			<div class="row grade-row">
    				<div class="form-group  col-lg-3">
	                        <label class="control-label" for="type">Sem/Term</label>
	                        <?php echo form_dropdown("sem",array(""=>"-Select-","1"=>"1st","2"=>"2nd","3"=>"Summer"),null,"class='form-control input-sm' id ='sem'"); ?>
	                	</div>
	                	<div class="form-group  col-lg-3">
	                        <label class="control-label" for="type">School Year</label>
	                        <?php echo form_dropdown("sy",array(""=>"-Select-",Date("Y",mktime(0,0,0,Date("m"),Date("d"),Date("Y")-1))."-".Date("Y",mktime(0,0,0,Date("m"),Date("d"),Date("Y")))=>Date("Y",mktime(0,0,0,Date("m"),Date("d"),Date("Y")-1))."-".Date("Y",mktime(0,0,0,Date("m"),Date("d"),Date("Y"))),Date("Y")."-".Date("Y",mktime(0,0,0,Date("m"),Date("d"),Date("Y")+1))=>Date("Y")."-".Date("Y",mktime(0,0,0,Date("m"),Date("d"),Date("Y")+1))),null,"class='form-control input-sm' id ='sy'"); ?>
	                	</div>
    			</div>
    			<div id = "old-grade"></div>
	    		<div class="row grade-row">
	    			
	    			<div class="form-group col-lg-2">	    				
	                    <label class="control-label" for="subj_code">SubjCode</label>
	                    <?php echo form_input(array("name"=>"subj_code[]","class"=>"form-control input-sm","placeholder"=>"Code","required"=>"required")); ?>
	                </div>
	    			<div class="form-group col-lg-5">
	                    <label class="control-label" for="subject">Subject Description</label>
	                    <?php echo form_input(array("name"=>"subject[]","class"=>"form-control input-sm","placeholder"=>"Subject Description","required"=>"required")); ?>
	                </div>
	                <div class="form-group col-lg-1">
	                    <label class="control-label" for="units">Units</label>
	                    <?php echo form_input(array("type"=>"number","step"=>"1","name"=>"units[]","class"=>"form-control input-sm units","placeholder"=>"","required"=>"required","min"=>"1","max"=>"6")); ?>
	                </div> 
	                <div class="form-group col-lg-2">
	                    <label class="control-label" for="midterm">Midterm</label>
	                    <?php echo form_input(array("type"=>"number","step"=>".25","name"=>"midterm[]","class"=>"form-control input-sm","placeholder"=>"Midterm","required"=>"required","min"=>"1.00","max"=>"5.00")); ?>
	                </div> 
	                <div class="form-group col-lg-2">
	                    <label class="control-label" for="final">Finals</label>
	                    <?php echo form_input(array("type"=>"number","step"=>".25","name"=>"final[]","class"=>"form-control input-sm final","placeholder"=>"Final","required"=>"required","min"=>"1.00","max"=>"5.00")); ?>
	                </div> 
	            </div>
	    		
	    		<div class="row">
	    			<div class="form-group col-lg-3">
	    			<div class = "btn btn-primary" id="btn-add"><i class="fa fa-plus"></i></div>
	    			</div>
    			</div>  
	    		
	    		<div class="form-group col-md-8 col-lg-5 ">
	    			<label class="control-label" for="adviser">Adviser</label>
	    			<?php echo form_input(array("type"=>"text","name"=>"adviser","class"=>"form-control input-sm final","placeholder"=>"Adviser","required"=>"required","max"=>"50")); ?>
	    		</div>	
	    		<div class="form-group col-md-8 col-lg-5 ">
	    			<label class="control-label" for="dean">Dean</label>
	    			<?php echo form_input(array("type"=>"text","name"=>"dean","class"=>"form-control input-sm final","placeholder"=>"Dean","required"=>"required","max"=>"50")); ?>
	    		</div>	
	    		<div class="form-group col-md-8 col-lg-3 ">
	    			<?php echo form_submit(array("value"=>"Save","class"=>"form-control btn btn-primary")) ?>
	    		</div>		
	    		  
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
			
			newGradeRow = $(".grade-row:last").clone();
			$(".grade-row:last").after(newGradeRow);
			$(newGradeRow).find("label").remove();
			$(newGradeRow).find("input").each(function(){
				$(this).val(null);
			});
			
		});
		
		$("#sy").bind("change",function(){
			//alert($("#stud_id").val());
			$.post("'.site_url("scholar/get_grade").'",{sem:$("#sem").val(),sy:$("#sy").val(),stud_id:$("#stud_id").val()},function(data){
				$.each(data,function(key,value){
					grade={
						subjcode:$("<div></div>").html(value.sub_code).addClass("form-control input-sm"),
						subj:$("<div></div>").html(value.sub_desc).addClass("form-control input-sm"),
						units:$("<div></div>").html(value.unit).addClass("form-control input-sm"),
						mg:$("<div></div>").html(value.mg).addClass("form-control input-sm"),
						fg:$("<div></div>").html(value.fg).addClass("form-control input-sm")
						};
					oldgrade=$("<div></div>").append($("<div></div>").addClass("form-group col-lg-2").append($(grade.subjcode)))
											.append($("<div></div>").addClass("form-group col-lg-5").append($(grade.subj)))
											.append($("<div></div>").addClass("form-group col-lg-1").append($(grade.units)))
											.append($("<div></div>").addClass("form-group col-lg-2").append($(grade.mg)))
											.append($("<div></div>").addClass("form-group col-lg-2").append($(grade.fg)));
					$("#old-grade").append($(oldgrade));
				});
				
			},"json");
		});
		
		/*$(".final").bind("blur",function(){
			var ave=0;
			var units=0;
			$(".grade-row").each(function(){
				ave = ave+(parseFloat($(this).find(".final").val())*parseFloat($(this).find(".units").val()));
				units += parseFloat($(this).find(".units").val());
			});
			$("#ave").val(parseFloat(ave/units));
		});*/
	});
</script>';
?>
<?php include("/../includes/footer.php");
