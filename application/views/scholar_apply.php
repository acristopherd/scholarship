
<?php 
$title = "Apply - Scholar";
$style='<style type="text/css">
	label.error{
		background:red;
		color:#EEE;
	}
	</style>';
include("includes/header.php"); ?>
<section class = "container main-container">
	<div class = "row">
		
		<div class="col-lg-6 col-md-8">
		<h1 class="page-header">
			Scholarship
		</h1>
		<?php echo form_open_multipart("scholar/apply",array("id"=>"apply"));?>
		        
        <!-- Tab panes -->
        <div class="tab-content">
            
            <div class="tab-pane fade in active" id="basic-info">
                <div class = "panel panel-default">
				<div class="panel-heading">
					Scholarship Information
				</div>
				<div class = "panel-body">	
	                
	                <div class="row">
	                	<div class="form-group  col-lg-6">
	                        <label class="control-label" for="scholar_type">Scholar Type</label>
	                        <?php echo form_dropdown("scholar_type",$type,set_value("scholar_type"),"class='form-control input-sm' id='type'"); ?>
	                        <?php echo form_error("scholar_type");?>
	                	</div>
	                </div>
	                <div class="row"> 
	                	<div class="form-group  col-lg-4">
	                        <label class="control-label" for="sem">Sem/Term</label>
	                        <?php echo form_dropdown("sem",array(""=>"-Select-","1"=>"1st","2"=>"2nd","3"=>"Summer"),set_value("sem"),"class='form-control input-sm' id ='sem'"); ?>
	                		<?php echo form_error("sem");?>
	                	</div>
	                	<div class="form-group  col-lg-4">
	                        <label class="control-label" for="sy">School Year</label>
	                        <?php echo form_dropdown("sy",array(Date("Y")."-".Date("Y",mktime(0,0,0,Date("m"),Date("d"),Date("Y")+1))=>Date("Y")."-".Date("Y",mktime(0,0,0,Date("m"),Date("d"),Date("Y")+1))),set_value("sy"),"class='form-control input-sm' id ='sy'"); ?>
	                		<?php echo form_error("sy");?>
	                	</div>
	                </div>
	                <div class="row">
	                    <div class="form-group col-lg-4">
	                        <label class="control-label" for="no_of_units">No of Units</label>
	                        <?php echo form_input(array("name"=>"no_of_units","class"=>"form-control input-sm","placeholder"=>"No of Units","type"=>"number","min"=>3,"max"=>"30","id"=>"units","value"=>set_value("no_of_units"))); ?>
	                    	<?php echo form_error("no_of_units");?>
	                    </div>                        
	                    <div class="form-group col-lg-4">
	                        <label class="control-label" for="no_of_subj">No of Subjects</label>
	                        <?php echo form_input(array("name"=>"no_of_subj","class"=>"form-control input-sm","placeholder"=>"No of Subjects","type"=>"number","min"=>4,"max"=>10,"value"=>set_value("no_of_subj"))); ?>
	                    	<?php echo form_error("no_of_subj");?>
	                    </div>  
	                </div>
	                <div class="row">
	                	<div class="form-group  col-lg-4">
	                        <label class="control-label" for="yr_lvl">Year Level</label>
	                        <?php echo form_dropdown("yr_lvl",array(""=>"-Select-","1"=>"I","2"=>"II","3"=>"III","4"=>"IV","5"=>"V"),set_value("yr_lvl"),"class='form-control input-sm'"); ?>
	                		<?php echo form_error("yr_lvl");?>
	                	</div>
	                	<div class="form-group  col-lg-4">
	                        <label class="control-label" for="college">College</label>
	                        <?php echo form_dropdown("college",$colleges,set_value("college"),"class='form-control input-sm'  id='college'"); ?>
	                		<?php echo form_error("college");?>
	                	</div>
	                	<div class="form-group  col-lg-4">
	                        <label class="control-label" for="course">Course</label>
	                        <?php echo form_dropdown("course",$courses,set_value("course"),"class='form-control input-sm' id='course'"); ?>
	                		<?php echo form_error("course");?>
	                	</div>
	                </div>
	                <div class = "requirements-box">
	                	<?php    
	                	if(isset($requirements)){             		
                		foreach($requirements as $key=>$requirement){
                		?>
                		<div class="form-group">
                			<label class="control-label" for="<?php echo $key ?>"><?php $requirement ?></label>
	                        <?php echo form_input(array("name"=>"requirements[]","class"=>"form-control input-sm","type"=>"file","accept"=>"image/*")); ?>
	                    </div>
	                    <?php		
                		}      
                		}          		
                		?>
	                </div>
                	
                </div>
                <div class="panel-footer">
                <div class="btn"><?php echo form_submit(array("value"=>"Save","class"=>"btn btn-success")); ?></div> 
                </div>
                </div>                       
            </div>
        </div>
			
		<?php echo form_close(); ?>
		
	</div>
</section>

<?php include("includes/footer.php"); ?>
<script type="text/javascript">
	$("#college").bind("change",function(){
		$.post("<?php echo site_url("course/getcourse")?>?sid="+Math.random(),{college:$(this).val()},function(data){
			$("#course").html(data);
		});
	});
	$("#units").bind("blur",function(){
		if($("#units").val()<15){
			if(confirm("You have a entered a value less than the minimum no. of units for scholarship which is 15. Click OK to confirm that you have enrolled the correct no. of units for your course this sem.")==0){
				$("#units").val('').focus();
			}
			
		}
	});
	$("form#apply").validate({
		rules: {  			             
            scholar_type:{
            	required:true
            },  
            sem:{
            	required:true
            },
            sy:{
            	required:true
            },
       		no_of_units:{
       			required:true
       		},
       		no_of_subj:{
       			required:true
       		},
       		yr_lvl:{
       			required:true
       		},
       		college:{
       			required:true
       		},
       		course:{
       			required:true
       		}
       },
       messages:{
       		scholar_type:{
       			required:"Choose a scholar type."
       		},
       		sem:{
       			required:"Choose a sem."
			},
       		sy:{
       			required:"Choose a school year."
       		},
       		no_of_units:{
       			required:"Enter number of units."
       		},
       		no_of_subj:{
       			required:"Enter number of subjects."
       		},
       		yr_lvl:{
       			required:"Choose a year level."
       		},
       		course:{
       			required:"Choose a course."
       		},
       		college:{
       			required:"Choose a college."
       		}
       }
	});
	
	$("#sem").bind("change",function(){
		if($("#sem").val()&&$("#sy").val()){
		$.post("<?php echo site_url("scholar/get_existing_scholarship")?>?sid="+Math.random(),{sem:$("#sem").val(),sy:$("#sy").val()},function(data){
			
			if(data.count>0){
				$().toastmessage("showToast",{
				    text     : "You have already applied for scholarship this semester.",
				    sticky   : false,
				    position : "middle-center",
				    type     : "success",
				    inEffectDuration:  600,   // in effect duration in miliseconds
					stayTime:         3000
				});
				$("#sem").val(0);
			}
			
		},"json");
		}
	});
	$("#sy").bind("change",function(){
		if($("#sem").val()&&$("#sy").val()){
		$.post("<?php echo site_url("scholar/get_existing_scholarship")?>?sid="+Math.random(),{sem:$("#sem").val(),sy:$("#sy").val()},function(data){
			if(data.count>0){
				$().toastmessage("showToast",{
				    text     : "You have already applied for scholarship this semester.",
				    sticky   : false,
				    position : "middle-center",
				    type     : "success",
				    inEffectDuration:  600,   // in effect duration in miliseconds
					stayTime:         3000
				});
				//alert();
				$("#sy").val(0);
			}
			
		},"json");
		}
	});
	$("#type").bind("change",function(){
			$(".requirements-box").html('');
			$.post("<?php echo site_url("scholar/get_requirements")?>",{type:$("#type").val()},function(data){
				$.each(data,function(key,value){
					newInput = $("<div></div>").addClass("form-group");					
					$(newInput).append('<label class="control-label" for="'+key+'">'+value+'</label>');
					$(newInput).append($("<input>").attr("name","requirements_"+key).attr("type","file").attr("accept","image/*").addClass("form-control input-sm"));
					$(".requirements-box").append($(newInput));
				});
				
			},"json");
		});
</script>
