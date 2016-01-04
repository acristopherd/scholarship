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
    <h1><!-- <?php echo $_GET['approved']==0?"Pending":"Approved"?> -->Pending Scholarship Signups</h1>
    <hr>
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-home"></i> <?php echo anchor("admin/","Home")?>
        </li>
        <li class="active">Pending Signups</li>
    </ol>
    <?php if(sizeof($scholars)>0){?>
    <div class = "container-fluid">  
    	    
    	<table class="table table-striped table-hover table-responsive" id ="scholars-table">
    		<thead><tr class="table-header"><th>No</th><th>F.Name</th><th>M.Name</th><th>L.Name</th><th>Sex</th><th>Town</th><th>Action</th></tr></thead>
    		<tbody>
    			<?php
    			$no=1;    			
				
    			foreach($scholars as $scholar){
    			//	if($this->session->userdata("access_level")==2||$this->session->userdata("admin_id")||$this->session->userdata("super_admin_id")||$scholar['info']->coll_id==$this->session->userdata("college_id")){
    			?>	    			
    			<tr>
    				<!--<td><?php //if(!$this->session->userdata("college_user_id"))echo form_checkbox(array("name"=>"aid[]","class"=>"form-input chk-approv"),$scholar['info']->aid);?></td>-->
    				<td><?php  echo $no++?></td>
    				<td><?php echo anchor('scholar/view_full_signup/'.$scholar->id.'/'.md5($scholar->id.$this->session->userdata('admin_secret')),$scholar->fname) ?></td><td><?php echo $scholar->mname?></td>
    				<td><?php echo $scholar->lname ?></td><td><?php echo $scholar->gender ?></td><td><?php echo $scholar->town ?></td>
    				
    				
    				<td><?php echo anchor('scholar/view_full_signup/'.$scholar->id.'/'.md5($scholar->id.$this->session->userdata('admin_secret')),'<i class="fa fa-file-text"></i>','class="btn btn-primary btn-sm"') ?>
    					<?php  echo ($scholar->account_approved==0) ? ((($this->session->userdata("admin_id")||$this->session->userdata("super_admin_id")))?anchor("scholar/approve_signup/".$scholar->id,"<i class='fa fa-check'></i>",array("class"=>"btn btn-sm btn-success","title"=>"Approve","data-toggle"=>"tooltip","data-placement"=>"top")):"<span class='btn  btn-sm btn-primary disabled'  data-toggle='tooltip' data-placement='top' title='not confirmed'> <i class='fa fa-check'></i></span>"): "<span class='btn  btn-sm btn-success disabled'  data-toggle='tooltip' data-placement='top' title='confirmed'> <i class='fa fa-check'></i></span>"?>
    					<?php  echo ($scholar->account_approved==0) ? ((($this->session->userdata("admin_id")||$this->session->userdata("super_admin_id")))?anchor("scholar/deny_signup/".$scholar->id."/".md5($scholar->id."denys1gnup"),"<i class='fa fa-times'></i>",array("class"=>"btn btn-sm btn-danger","title"=>"Deny","data-toggle"=>"tooltip","data-placement"=>"top")):"<span class='btn  btn-sm btn-primary disabled'  data-toggle='tooltip' data-placement='top' title='not confirmed'> <i class='fa fa-times'></i></span>"): "<span class='btn  btn-sm btn-danger disabled'  data-toggle='tooltip' data-placement='top' title='confirmed'> <i class='fa fa-check'></i></span>"?>
    					
    				</td>
    			</tr>
    			<?php
    			//	}
    			}
				?>
    		</tbody>
    	</table>
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
    <?php 
    }
	else{
	?>
	<div class="alert alert-danger">No records to show.</div>
	<?php	
	}
?>
</div>
<?php  $this->load->view('admin/includes/footer.php');?>
 <script src="<?php echo base_url();?>js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url();?>js/plugins/dataTables/dataTables.bootstrap.js"></script>

   
    <script>
    $(document).ready(function() {
        $('#scholars-table').dataTable();
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
