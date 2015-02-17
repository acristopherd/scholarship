<?php 
//$headscript="<script src='https://www.google.com/recaptcha/api.js'></script>";
$style='<style type = "text/css">
	input[type="text"]{
		text-transform:capitalize;
	}
	label.error{
		background:red;
		color:#EEE;
	}
</style>';
require_once("includes/header.php"); ?>
<section class = "container main-container">
	<div class = "row">
		
		<div class="col-lg-6 col-md-8">
		<h1 class="h1">
			Signup
		</h1>
		<?php echo form_open("scholar/add",array("name"=>"signup","id"=>"signup"));?>
		        
        <!-- Tab panes -->
        <div class="tab-content">
            
            <div class="tab-pane fade in active" id="basic-info">
                <div class = "panel panel-default">
				<div class="panel-heading">
					Personal Information
				</div>
				<div class = "panel-body">	
	                <div class="row">
	                    <div class="form-group col-lg-5">
	                        <label class="control-label" for="firstname">Firstname</label>
	                        <?php echo form_input(array("name"=>"firstname","class"=>"form-control input-sm","placeholder"=>"First Name","required"=>"","id"=>"firstname"),set_value("firstname")); ?>
	                    	<?php echo form_error('firstname'); ?>
	                    </div>                        
	                    <div class="form-group  col-lg-3">
	                        <label class="control-label" for="middlename">Middlename</label>
	                        <?php echo form_input(array("name"=>"middlename","class"=>"form-control input-sm","placeholder"=>"Middle Name","id"=>"middlename"),set_value("middlename")); ?>
	                    	<?php echo form_error('middlename'); ?>
	                    </div>
	                    <div class="form-group  col-lg-4">
	                        <label class="control-label" for="lastname">Lastname</label>
	                        <?php echo form_input(array("name"=>"lastname","class"=>"form-control input-sm","placeholder"=>"Last Name","required"=>"","id"=>"lastname","data-placement"=>"right","title"=>"Error","data-toggle"=>"popover","data-content"=>"You have already signed up for an account."),set_value("lastname")); ?>
	                    	<?php echo form_error('lastname'); ?>
	                    </div>
	                </div>
	                <div class="row">
	                	<div class="form-group  col-lg-4">
	                        <label class="control-label" for="bdate">Birthdate</label>
	                        <?php echo form_input(array("type"=>"date","max"=>date("Y-m-d",mktime(0,0,0,date('m'),date('d'),date('Y')-14)),"name"=>"bdate","class"=>"form-control input-sm","placeholder"=>"Birthdate","required"=>""),set_value("bdate")); ?>
	                		<?php echo form_error('bdate'); ?>
	                    </div>
	                	<div class="form-group  col-lg-4">
	                        <label class="control-label" for="sex">Sex</label>
	                        <?php echo form_dropdown("sex",array(""=>"-Select-","Male"=>"Male",'Female'=>"Female"),set_value("sex"),"class='form-control input-sm' required"); ?>
	                		<?php echo form_error('sex'); ?>
	                    </div>
	                	<div class="form-group  col-lg-4">
	                        <label class="control-label" for="status">Civil Status</label>
	                        <?php echo form_dropdown("status",array(""=>"-Select-","Single"=>"Single","Maried"=>"Maried","Widowed"=>"Widowed","Separated"=>"Separated"),set_value("status"),"class='form-control input-sm' required"); ?>
	                		<?php echo form_error('status'); ?>
	                    </div>
	                </div>
	                <div class="row"> 
	                	<div class="form-group  col-lg-8">
	                        <label class="control-label" for="contact">Contact No.</label>
                        	<?php echo form_input(array("name"=>"contact","class"=>"form-control input-sm","placeholder"=>"Contact No."),set_value("contact")); ?>
                			<?php echo form_error('contact'); ?>
	                    </div>
	                </div>
	                <div class="row">                        
	                    <div class="form-group  col-lg-4">
	                        <label class="control-label" for="brgy">Barangay</label>
	                        <?php echo form_input(array("name"=>"brgy","class"=>"form-control input-sm","placeholder"=>"Barangay","required"=>""),set_value("brgy")); ?>
	                    	<?php echo form_error('brgy'); ?>
	                    </div>
	                    <div class="form-group  col-lg-4">
	                        <label class="control-label" for="town">Town</label>
	                        <?php echo form_input(array("name"=>"town","class"=>"form-control input-sm","placeholder"=>"Town","required"=>""),set_value("town")); ?>
	                    	<?php echo form_error('town'); ?>
	                    </div>
	                    <div class="form-group  col-lg-4">
	                        <label class="control-label" for="prov">Province</label>
	                        <?php echo form_input(array("name"=>"prov","class"=>"form-control input-sm","placeholder"=>"Province","required"=>""),set_value("prov")); ?>
	                    	<?php echo form_error('prov'); ?>
	                    </div>
	                </div>
                </div>
                <div class="panel-footer">
                <div ><a href="#family" data-toggle="tab" aria-expanded="false" class="btn btn-primary">Next</a></div> 
                </div>
                </div>                       
            </div>
            <div class="tab-pane fade" id="family">
            	<div class = "panel panel-default">
				<div class="panel-heading">
					Family Background
				</div>
				<div class = "panel-body">
					<?php
					$educ = array(	"Elementary Level"=>"Elementary Level",
									"Elementary Graduate"=>"Elementary Graduate",
									"High School Level"=>"High School Level",
									"High School Graduate"=>"High School Graduate",
									"College Level"=>"College Level",
									"College Graduate"=>"College Graduate",
									"Post Graduate"=>"Post Graduate");
					?>
	                <div class="row">
	                    <div class="form-group col-lg-10">
	                        <label class="control-label" for="father">Father</label>
	                        <?php echo form_input(array("name"=>"father","class"=>"form-control input-sm","placeholder"=>"Father's Name"),set_value("father")); ?>
	                    	<?php echo form_error('father'); ?>
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="form-group col-lg-6">
	                        <label class="control-label" for="father_occu">Occupation</label>
	                        <?php echo form_input(array("name"=>"father_occu","class"=>"form-control input-sm","placeholder"=>"Occupation"),set_value("father_occu")); ?>
	                    	<?php echo form_error('father_occu'); ?>
	                    </div>
	                    <div class="form-group col-lg-6">
	                        <label class="control-label" for="father_educ">Father Educational Attainment</label>
	                        <?php echo form_dropdown("father_educ",$educ,set_value("father_educ"),"class = 'form-control input-sm input-right'"); ?>
	                   	<?php echo form_error('father_educ'); ?>
	                     </div>
	                </div>
	                <div class="row">
	                    <div class="form-group col-lg-10">
	                        <label class="control-label" for="mother">Mother</label>
	                        <?php echo form_input(array("name"=>"mother","class"=>"form-control input-sm","placeholder"=>"Mother's Name"),set_value("mother")); ?>
	                    	<?php echo form_error('mother'); ?>
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="form-group col-lg-6">
	                        <label class="control-label" for="mother_occu">Occupation</label>
	                        <?php echo form_input(array("name"=>"mother_occu","class"=>"form-control input-sm","placeholder"=>"Occupation"),set_value("mother_occu")); ?>
	                    	<?php echo form_error('mother_occu'); ?>
	                    </div>
	                    <div class="form-group col-lg-6">
	                        <label class="control-label" for="mother_educ">Mother Educational Attainment</label>
	                        <?php echo form_dropdown("mother_educ",$educ,set_value("mother_educ"),"class = 'form-control input-sm input-right'"); ?>
	                   		<?php echo form_error('mother_educ'); ?>
	                    </div>
	                </div>
                	<div class="form-group ">	                  
                		 
                		<label class="control-label" for="income">Combined Monthly Income</label>  
                		<div class="input-group col-lg-8">  	
                        <span class="input-group-addon">Php</span>
                        <?php echo form_input(array("type"=>"number","min"=>"1","max"=>"1000000","name"=>"income","id"=>"income","class"=>"form-control","placeholder"=>"Combined Monthly Income","required"=>""),set_value("income")); ?>
                        <span class="input-group-addon">.00</span>
                        </div>
                        <?php echo form_error('income'); ?>
	                    
                    </div>
                    <div class="form-group col-lg-4">
                        <label class="control-label" for="no_of_children">No of Children</label>
                        <?php echo form_input(array("type"=>"number","min"=>"1","max"=>"20","name"=>"no_of_children","class"=>"form-control input-sm number","placeholder"=>"No of Children in the family","required"=>""),set_value("no_of_children")); ?>
                    	<?php echo form_error('no_of_children'); ?>
	                </div>
	            </div>
	            <div class="panel-footer">
	            	<div><a href="#basic-info" data-toggle="tab" aria-expanded="false"  class="btn btn-primary">Back</a><a href="#education" data-toggle="tab" aria-expanded="false" class="btn btn-primary">Next</a></div>
	            </div>
	            </div>
            </div>  
            <div class="tab-pane fade" id="education">
            	<div class = "panel panel-default">
				<div class="panel-heading">
					Educational Background
				</div>
                <div class="panel-body">
                <div class="form-group">
                    <label class="control-label" for="school_grad">School Graduated</label>
                    <?php echo form_input(array("name"=>"school_grad","class"=>"form-control input-sm","placeholder"=>"School Graduated","required"=>""),set_value("school_grad")); ?>
                	<?php echo form_error('school_grad'); ?>
	            </div>
                <div class="form-group">
                    <label class="control-label" for="school_addr">School Address</label>
                    <?php echo form_input(array("name"=>"school_addr","class"=>"form-control input-sm","placeholder"=>"Address of school where you graduated.","required"=>""),set_value("school_addr")); ?>
                	<?php echo form_error('school_addr'); ?>
	            </div>
                </div>
                <div class="panel-footer">
                   	<div ><a href="#family" data-toggle="tab" aria-expanded="false" class="btn btn-primary">Back</a><a href="#account" data-toggle="tab" aria-expanded="false" class="btn btn-primary">Next</a></div>
                </div>
            	</div>                         
        	</div>
        	<div class="tab-pane fade" id="account">
            	<div class = "panel panel-default">
				<div class="panel-heading">
					Account
				</div>
                <div class="panel-body">
                <div class="form-group">
                    <label class="control-label" for="email">Email</label>
                    <div class="input-group">
                    <span class="input-group-addon input-sm">@</span>
                    <?php echo form_input(array("name"=>"email","class"=>"form-control input-sm","placeholder"=>"Email","required"=>"","type"=>"email","id"=>"email"),set_value("email")); ?>
                    </div>
                	<?php echo form_error('email'); ?>
	            </div>
                <div class="form-group">
                    <label class="control-label" for="pass">Password</label>
                    <div class="input-group">
                    <span class="input-group-addon input-sm"><i class="fa fa-lock"></i></span>
                    <?php echo form_password(array("name"=>"pass","id"=>"pass","class"=>"form-control input-sm","placeholder"=>"Password","required"=>"")); ?>
                	
                	</div>
                	<span class="label label-warning">Password should be at least 8 characters and a combination of uppercase,lowercase and number.</span>
                	<?php echo form_error('pass'); ?>
	            </div>
	            <div class="form-group">
                    <label class="control-label" for="pass">Confirm Password</label>
                    <div class="input-group">
                    <span class="input-group-addon input-sm"><i class="fa fa-lock"></i></span>
                    <?php echo form_password(array("name"=>"cpass","id"=>"cpass","class"=>"form-control input-sm","placeholder"=>"ConfirmPassword","required"=>"")); ?>
                	</div>
                	<?php echo form_error('cpass'); ?>
	            </div>
	            <div class="form-group col-lg-9">
                    <div class="panel panel-warning">
                    	<div class="panel-heading"><div class="row">Type the words below</div> 
                    	<span><img id="captcha-image" class="img" src="" /></span>
                    		<span  class="btn btn-primary" id="btnrecaptcha" ><i class="fa fa-refresh"></i></span>	
                    	</div>
                    	<div class="panel-body">
                    		<?php echo form_input(array("name"=>"captcha","class"=>"form-control input-sm")) ?>                    			
                    		
                    	</div>
                    	<div class="panel-footer">
                    		<?php echo form_error('captcha'); ?>
                    	</div>
                    </div>
	            </div>
                </div>
                <div class="panel-footer">
                   	<a class="btn btn-primary" href="#education" data-toggle="tab" aria-expanded="false">Back</a> <div class="btn"><?php echo form_submit(array("value"=>"Save","class"=>"btn btn-success")); ?></div>
                </div>
            	</div>                         
        	</div>
        </div>
			
		<?php echo form_close(); ?>
		
	</div>
</section>
<script type="text/javascript">
	
</script>

<?php 
$script='<script type="text/javascript">
$(document).ready(function(){
	$("#btnrecaptcha").click(function(){		
		$("#captcha-image").hide().after("<div>Loading...</div>");
		$.post("'.site_url("captcha/recaptcha").'",function(data){
			$("#captcha-image").attr("src",data).fadeIn("fast").next().hide();
		});
	});
	$.post("'.site_url("captcha/recaptcha").'",function(data){
		$("#captcha-image").attr("src",data);
	});
		
	$("form#signup").validate({
		rules: {  			             
            email:{
            	required:true,
            	email:true
            },  
            pass:{
            	minlength:8
            },
            cpass:{
            	minlength:8,
            	equalTo:"#pass"
            },
            income:{
            	number:true,
            	min:0,
            	max:1000000
            }
       },
       messages:{
       		email:{
       			email:"Enter a valid email.",
       			required:""
       		},
       		pass:{
       			minlength:"Password too short. Min of 8 characters."
			},
       		cpass:{
       			minlength:"Password too short. Min of 8 characters.",
       			equalTo:"Password did not match."
       		},
       		income:{
       			min:"enter a number",
       			number:"enter a number"
       		}
       }
	});
	
	$("input[type=\'number\']").bind("blur",function(){
		if(!$(this).valid()){
		$().toastmessage("showToast",{
		    text     : "This is a numeric field.",
		    sticky   : false,
		    position : "top-center",
		    type     : "success",
		    inEffectDuration:  600,   // in effect duration in miliseconds
			stayTime:         2000
		});
			$(this).focus();
		}
		//if($.isNumeric($(this).val())) alert(1);
	});
	
	$("#lastname").bind("blur",function(){
		$.post("'.site_url("scholar/get_existing_scholar").'?sid="+Math.random(),{firstname:$("#firstname").val(),middlename:$("#middlename").val(),lastname:$("#lastname").val()},function(data){
			if(data.count>0){
				$("#lastname").popover("show");
				$("#lastname").focus();
			}
		},"json");
	});
	/*
	$("#lastname").bind("blur",function(){
		$.post("'.site_url("scholar/get_existing_scholar").'?sid="+Math.random(),{firstname:$("#firstname").val(),middlename:$("#middlename").val(),lastname:$("#lastname").val()},function(data){
			if(data.count>0){
				$().toastmessage("showToast",{
				    text     : "You have already signed up for a scholarship account.",
				    sticky   : false,
				    position : "top-center",
				    type     : "success",
				    inEffectDuration:  600,   // in effect duration in miliseconds
					stayTime:         3000
				});
				//$("#firstname,#middlename,#lastname").val("");
				$("#lastname").focus();
			}
		},"json");
	});
	*/
	$("#email").bind("blur",function(){
		
		$.post("'.site_url("scholar/get_existing_email").'?sid="+Math.random(),{email:$("#email").val()},function(data){
			console.log(data);
			if(data.count>0){
				alert("This email is in use. Please use a different email address.");
				$("#email").val("").focus();
			}
		},"json");
	});
	
});
		</script>';
include("includes/footer.php"); ?>