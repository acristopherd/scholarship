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
    <h1><?php echo $scholar->fname. " ".$scholar->mname." " .$scholar->lname?></h1>
    <hr>
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-home"></i> <?php echo anchor("admin/","Home")?>
        </li>
        <li>
            <?php echo anchor("scholar/view_signups","Pending Signups")?>
        </li>
        <li class="active"> <?php echo $scholar->fname. " ".$scholar->mname." " .$scholar->lname?></li>
    </ol>
    
    <div class = "container-fluid">  
    	 <div  class=" col-sm-6">
    	<table class="table table-bordered table-striped table-hover table-responsive ">
    		<tbody>
    			<tr>
    				<th colspan="2" class="alert alert-info">Personal Information</th>
    			</tr>
    			<tr>
    				<th>ID No</th><td><?php echo $scholar->stud_No?></td>
    			</tr>   			
    			<tr>
    				<th>Firstname</th><td><?php echo $scholar->fname?></td>
    			</tr>
    			<tr>
    				<th>Middlename</th><td><?php echo $scholar->mname?></td>
    			</tr>
    			<tr>
    				<th>Lastname</th><td><?php echo $scholar->lname?></td>
    			</tr>
    			
    			<tr>
    				<th>Birthdate</th><td><?php $scholar->birthdate?></td>
    			</tr>
    			<tr>
    				<th>Gender</th><td><?php echo $scholar->gender?></td>
    			</tr>
    			<tr>
    				<th>Civil Status</th><td><?php echo $scholar->civil_status?></td>
    			</tr>
    			<tr>
    				<th>Contact No.</th><td><?php echo $scholar->contact_no?></td>
    			</tr>
    			<tr>
    				<th>Email Add</th><td><?php echo mailto($scholar->email,$scholar->email)?></td>
    			</tr>
    			<tr>
    				<th>Barangay</th><td><?php echo $scholar->brgy?></td>
    			</tr>
    			<tr>
    				<th>City/Town</th><td><?php echo $scholar->town?></td>
    			</tr>
    			<tr>
    				<th>Province</th><td><?php echo $scholar->prov?></td>
    			</tr>
    		</tbody>
    	</table>
    	<table class="table table-bordered table-striped table-hover table-responsive ">
    		<tbody>
    			<tr>
    				<th colspan="2" class="alert alert-info">Family Background</th>
    			</tr>
    			<tr>
    				<th>Father</th><td><?php echo $scholar->fa_name?></td>
    			</tr>
    			<tr>
    				<th>F. Occupation</th><td><?php echo $scholar->fa_occup?></td>
    			</tr>
    			<tr>
    				<th>F. Education</th><td><?php echo $scholar->fa_educ?></td>
    			</tr>
    			<tr>
    				<th>Mother</th><td><?php echo $scholar->mo_name?></td>
    			</tr>
    			<tr>
    				<th>M. Occupation</th><td><?php echo $scholar->mo_occup?></td>
    			</tr>
    			<tr>
    				<th>M. Education</th><td><?php echo $scholar->mo_educ?></td>
    			</tr>
    			<tr>
    				<th>Monthly Income</th><td><?php echo $scholar->com_mon_inc ?></td>
    			</tr>
    			<tr>
    				<th>No of Children</th><td><?php echo $scholar->no_of_chil?></td>
    			</tr>
    		</tbody>
    	</table>
    	<table class="table table-bordered table-striped table-hover table-responsive ">
    		<tbody>
    			<tr>
    				<th colspan="2" class="alert alert-info">Educational Background</th>
    			</tr>
    			<tr>
    				<th>School</th><td><?php echo $scholar->school_grad?></td>
    			</tr>
    			<tr>
    				<th>Address</th><td><?php echo $scholar->addr_school?></td>
    			</tr>
    			
    		</tbody>
    	</table>
    	</div>
    	<!--
    	<?php
    	if(!$this->session->userdata("college_user_id")){
    	?>
    	<span class="btn btn-default" id = "check-all">Check All</span>
    	<?php echo form_submit(array("name"=>"btn_approv_all","class"=>"btn btn-primary"),"Approve Selected")?>
    	<?php
		}
		?>-->
    	
    </div>
    
</div>
<?php  $this->load->view('admin/includes/footer.php');?>
 <script src="<?php echo base_url();?>js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url();?>js/plugins/dataTables/dataTables.bootstrap.js"></script>

   
    <script>
    $(document).ready(function() {
        
         $('[data-toggle="tooltip"]').tooltip();  
         $("#check-all").click(function(){
         	$(".chk-approv").attr("checked","checked");
         });
         $("#btn-print").click(function(e){
         	var w = window.open($(this).attr("href"),"Print Window","height=1000,width=1000,menubar=0,location=0");
         	e.preventDefault();
         });
         $(".btn-print-grade").click(function(e){
         	var w = window.open($(this).attr("href"),"Print Window","height=1000,width=1000,menubar=0,location=0");
         	e.preventDefault();
         });
    });
    </script>
