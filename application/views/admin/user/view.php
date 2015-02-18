<?php $page_title = "Users View - Admin";
$style='<style type = "text/css">
	.capitalize{
		text-transform:capitalize;
	}
</style>'; ?>
<?php $this->load->view('admin/includes/header.php');?>
<div id="page-wrapper">
    <h1> Users</h1>
    <div class="row">
    <div class="container col-lg-6">
    <div class="panel panel-primary">
    	<div class="panel-heading">
    		Add User
    	</div>
    	<div class="panel-body">
    		<?php echo form_open("user/add",array("class"=>"form"));?>		    	
	    		<div class="">
	    			
	    			 <div class="row">
	                    <div class="form-group col-lg-5">
	                        <label class="control-label" for="firstname">Firstname</label>
	                        <?php echo form_input(array("name"=>"firstname","class"=>"form-control input-sm capitalize","placeholder"=>"First Name","required"=>""),set_value("firstname")); ?>
	                    	<?php echo form_error('firstname'); ?>
	                    </div>                        
	                    <div class="form-group  col-lg-3">
	                        <label class="control-label" for="middlename">Middlename</label>
	                        <?php echo form_input(array("name"=>"middlename","class"=>"form-control input-sm capitalize","placeholder"=>"Middle Name"),set_value("middlename")); ?>
	                    	<?php echo form_error('middlename'); ?>
	                    </div>
	                    <div class="form-group  col-lg-4">
	                        <label class="control-label" for="lastname">Lastname</label>
	                        <?php echo form_input(array("name"=>"lastname","class"=>"form-control input-sm capitalize","placeholder"=>"Last Name","required"=>""),set_value("lastname")); ?>
	                    	<?php echo form_error('lastname'); ?>
	                    </div>
	                </div>
	                <div class="row">
	                	<div class="form-group col-lg-8 col-md-10">
	                    <label class="control-label" for="uname">Username</label>
	                    <div class="input-group">
	                    <span class="input-group-addon input-sm"><i class="fa fa-user"></i></span>
	                    <?php echo form_input(array("name"=>"uname","class"=>"form-control input-sm","placeholder"=>"Username","required"=>"","type"=>"text"),set_value("uname")); ?>
	                    </div>
	                	<?php echo form_error('email'); ?>
		            	</div>
	                </div>
	                <div class="row">
	                	 <div class="form-group col-lg-8 col-md-10">
	                    <label class="control-label" for="pass">Password</label>
	                    <div class="input-group">
	                    <span class="input-group-addon input-sm"><i class="fa fa-lock"></i></span><?php echo form_password(array("name"=>"pass","class"=>"form-control input-sm","placeholder"=>"Password","required"=>"")); ?>
	                	
	                	</div>
	                	<?php echo form_error('pass'); ?>
		           		</div>
	                </div>
	                <div class="row">
	                	<div class="form-group col-lg-8 col-md-10">
	                    <label class="control-label" for="pass">Confirm Password</label>
	                    <div class="input-group">
	                    <span class="input-group-addon input-sm"><i class="fa fa-lock"></i></span>
	                    <?php echo form_password(array("name"=>"cpass","class"=>"form-control input-sm","placeholder"=>"ConfirmPassword","required"=>"")); ?>
	                	</div>
	                	<?php echo form_error('cpass'); ?>
		            </div>
	                </div>
	                 <div class="row"> 
	                	<div class="form-group  col-lg-4">
	                        <label class="control-label" for="lvl">Access Level</label>
	                        <?php echo form_dropdown("lvl",array(""=>"-Select-","1"=>"Grantee","2"=>"Staff","3"=>"College","4"=>"Admin","5"=>"Super Admin"),set_value("lvl"),"required = 'required' class='form-control input-sm' id ='lvl'"); ?>
	                		<?php echo form_error("lvl");?>
	                	</div>
	                </div>
	                <div class="row hidden" id="type-row"> 
	                	<div class="form-group  col-lg-4">
	                        <label class="control-label" for="type">Scholarship</label>
	                        <?php echo form_dropdown("type",$types,set_value("type"),"required = 'required' class='form-control input-sm' id ='type'"); ?>
	                		<?php echo form_error("type");?>
	                	</div>
	                </div>
	                <div class="row hidden" id="college-row"> 
	                	<div class="form-group  col-lg-4">
	                        <label class="control-label" for="college">College</label>
	                        <?php echo form_dropdown("college",$colleges,set_value("college"),"required = 'required' class='form-control input-sm' id ='college'"); ?>
	                		<?php echo form_error("college");?>
	                	</div>
	                </div>
	    		</div>
	    		<div class="row">
	    		<div class="form-group col-md-8 col-lg-4">
	    			<?php echo form_submit(array("value"=>"Save","class"=>"form-control btn btn-primary")) ?>
	    		</div>		
	    		</div>    	
		    <?php echo form_close();?>
    	</div>
    </div>    	
    </div>
    </div>
    <div class = "row">    	
    	<h3 class="">List of Users</h3>
    	<table class="table table-striped table-hover table-responsive">
    		<thead><tr class="table-header"><th>No</th><th>Name</th><th>Username</th><th>Account Type</th><th>Scholarship</th><th>College</th><th>Actions</th></tr></thead>
    		<tbody>
    			<?php
    			$no=1;
    			foreach($users as $user){
    				$account_type="";
    				switch($user->access_level){
						case 1:
							$account_type="Grantee";
							break;
						case 2:
							$account_type="Staff";
							break;
						case 3:
							$account_type="College";
							break;
						case 4:
							$account_type="Admin";
							break;
						case 5:
							$account_type="Super Admin";
							break;
							
    				}
					//a5<u4
				if($user->access_level<=$this->session->userdata("access_level")||$this->session->userdata("access_level")>=5){
    			?>
    			
    			<tr><td><?php echo $no++?></td><td><?php echo $user->fname." ".$user->mname." ".$user->lname ?></td>
    				<td><?php echo $user->username?></td><td><?php echo $account_type?></td>
    				<td><?php echo !empty($user->type_id)?$user->type:""?></td>
    				<td><?php echo !empty($user->college_id)?$user->college:""?></td>
    				<td><?php echo anchor("user/delete/".$user->id."/".md5($user->id."dletm3"),"<i class='fa fa-trash-o'></i>",array("title"=>"Reset Password","class"=>"btn-delete")) ?>
    					<?php echo anchor("user/reset_pw/".$user->id."/".md5($user->id."restm3"),"<i class='fa fa-asterisk'></i>",array("title"=>"Reset Password")) ?>
    				</td>
    			</tr>
    			<?php
				}
				
    			}
				?>
    		</tbody>
    	</table>
    </div>
</div>
<?php  $this->load->view('admin/includes/footer.php');?>
<script type="text/javascript">
	$(document).ready(function() {
		$("#lvl").change(function(){			
			if($(this).val()==1||$(this).val()=="1"){
				$("#type-row").removeClass("hidden");
				$("#college-row").addClass("hidden");
			}
			else if($(this).val()==3||$(this).val()=="3"){
				$("#type-row").addClass("hidden");
				$("#college-row").removeClass("hidden");
			}
			else{
				$("#type-row").addClass("hidden");
				$("#college-row").addClass("hidden");
			}
		});
		$(".btn-delete").bind("click",function(e){
			if(confirm("Are you sure you want to delete this user? This action cannot be undone.")==0){
				e.preventDefault();
			}
		});
	});
</script>