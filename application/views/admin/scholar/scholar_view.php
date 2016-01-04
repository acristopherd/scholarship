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
    <h1> <?php echo $_GET['approved']==0?"Pending":"Approved"?> Scholarship</h1>
    <hr>
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-home"></i> <?php echo anchor("admin/","Home")?>
        </li>
        <li class="active"><?php echo $_GET['approved']==0?"Pending":"Approved"?> Scholarship</li>
    </ol>
    <div class="row-fluid">
    	<div class="panel panel-primary">
    		<div class="panel-heading">
    			<b>Filters:</b>
    		</div>
    		<div class="panel-body">
    			<?php echo form_open("scholar/view_scholar",array("class"=>"form","role"=>"form","method"=>"get"));?>
    			<div class="row-fluid">
    			<div class="form-group col-lg-3 col-md-3"><div class="input-group"><?php echo form_label("S.Y.:","sy",array("class"=>"input-group-addon")); echo form_dropdown("sy",$sys,$selected['sy'],"class='form-control'")?></div></div>
    			<div class="form-group col-lg-3 col-md-3"><div class="input-group"><?php echo form_label("Sem:","sem",array("class"=>"input-group-addon")); echo form_dropdown("sem",$sems,$selected['sem'],"class='form-control'")?></div></div>
		    	<div class="form-group col-lg-3 col-md-3"><div class="input-group"><?php echo form_label("College:","college",array("class"=>"input-group-addon")); echo form_dropdown("college",$colleges,$selected['college'],"class='form-control'")?></div></div>
		    	<div class="form-group col-lg-3 col-md-3"><div class="input-group"><?php echo form_label("Course:","course",array("class"=>"input-group-addon")); echo form_dropdown("course",$courses,$selected['course'],"class='form-control'")?></div></div>
		    	
		    	<div class="form-group col-lg-3 col-md-3"><div class="input-group"><?php echo form_label("Town:","town",array("class"=>"input-group-addon")); echo form_dropdown("town",$towns,$selected['town'],"class='form-control'")?></div></div>
		    	<div class="form-group col-lg-3 col-md-3"><div class="input-group"><?php echo form_label("Sex:","sex",array("class"=>"input-group-addon")); echo form_dropdown("sex",array("-1"=>"All","Male"=>"Male","Female"=>"Female"),$selected['sex']?$selected['sex']:-1,"class='form-control'")?></div></div>
		    	<div class="form-group col-lg-3 col-md-3"><div class="input-group"><?php echo form_label("Status:","approved",array("class"=>"input-group-addon")); echo form_dropdown("approved",array("-1"=>"All","1"=>"Approved","0"=>"Not Approved"),$selected['sex']?$selected['approved']:-1,"class='form-control'")?></div></div>
		    	<div class="form-group col-lg-3 col-md-3"><div class="input-group"><?php echo form_label("Scholarhip:","type",array("class"=>"input-group-addon")); echo form_dropdown("type",$types,$selected['type'],"class='form-control'")?></div></div>
		    	</div>
		    	<div class="container-fluid">
		    	<?php echo form_submit(array("class"=>"btn btn-primary","id"=>"btn-apply"),"Apply");?>
		    	</div>
		    	<?php echo form_close(); ?>
    		</div>
    		<div class="panel-footer">
    			<div class="container-fluid">
    			<?php 	echo form_open(site_url("scholar/view_scholar/")."?approved=".$_GET['approved'],array("class"=>"form-inline","role"=>"form"));
						echo form_submit(array("class"=>"btn btn-warning"),"Reset");
    					echo form_close();
    			?>
    			</div>
    		</div>
    	</div>
    	
    </div>
    <?php if(sizeof($scholars)>0){?>
    <div class = "row-fluid">  
    	<?php $url = "";
    		foreach($_GET as $key=>$value){
    			$url .=$key."=".$value."&";
    		}
			
    	?>
    	<a class="btn btn-primary" href = "<?php echo site_url("scholar/print_scholar")."?".$url?>" id ="btn-print">Print</a>
    	<?php echo form_open("scholar/approv_all");?>  	    
    	<table class="table table-striped table-hover table-responsive" id ="scholars-table">
    		<thead><tr class="table-header"><th>No</th><th>F.Name</th><th>M.Name</th><th>L.Name</th><th>Sex</th><th>Town</th><th>Scholarship</th><th>Requirements</th><th>Action</th></tr></thead>
    		<tbody>
    			<?php
    			$no=1;    			
				
    			foreach($scholars as $scholar){
    				if($this->session->userdata("access_level")==2||$this->session->userdata("admin_id")||$this->session->userdata("super_admin_id")||$scholar['info']->coll_id==$this->session->userdata("college_id")){
    			?>	    			
    			<tr>
    				<!--<td><?php if(!$this->session->userdata("college_user_id"))echo form_checkbox(array("name"=>"aid[]","class"=>"form-input chk-approv"),$scholar['info']->aid);?></td>--><td><?php  echo $no++?></td><td><?php echo $scholar['info']->fname ?></td><td><?php echo $scholar['info']->mname?></td>
    				<td><?php echo $scholar['info']->lname ?></td><td><?php echo $scholar['info']->gender ?></td><td><?php echo $scholar['info']->town ?></td>
    				<td><?php echo $scholar['info']->type ?></td>
    				<td>
    					<a href = "<?php echo $scholar['info']->average>0?site_url("scholar/print_grade/".$scholar['info']->aid."/".md5($scholar['info']->aid.$this->session->userdata("admin_secret"))):"#"?>" class="requirement btn btn-sm btn-<?php echo $scholar['info']->average>0? "success": "danger disabled";?>"
    						title = "<?php echo $scholar['info']->average>0? "Weighted Average": "Not yet submitted.";?>" data-toggle="tooltip" data-placement="top"> <?php echo $scholar['info']->average?number_format($scholar['info']->average,2):"Ave" ?></a>
    					<?php 
    					$lacks=!($scholar['info']->average>0);    				
	    				foreach($scholar['requirements'] as $requirement){
	    					$lacks=$lacks||empty($requirement->file_name);
	    				?>
	    				<a href = "<?php echo empty($requirement->file_name)?"#":base_url()."requirements/".$requirement->file_name ?>" class="requirement btn btn-sm btn-<?php echo empty($requirement->file_name)? "danger disabled": "success";?>"
	    					title = "<?php echo $requirement->requ_name ?>"  data-toggle="tooltip" data-placement="top"><?php echo $requirement->requ_name ?></a>
	    				<?php
	    				}    
						?>
	    			</td>
    				<td><div class="btn-group"><?php echo ($this->session->userdata("college_user_id")&&$this->session->userdata("college_id")==$scholar['info']->coll_id)||$this->session->userdata("super_admin_id")||$this->session->userdata("admin_id")?anchor("scholar/encode_grade/".$scholar['info']->aid."/".$scholar['info']->semester."/".$scholar['info']->sy,"<i class='fa fa-edit'></i>",array("class"=>"btn btn-sm btn-primary","title"=>"encode grade","data-toggle"=>"tooltip","data-placement"=>"top")):""?>
    					<?php echo anchor("scholar/print_grade/".$scholar['info']->aid."/".md5($scholar['info']->aid.$this->session->userdata("admin_secret")),"<i class='fa fa-print'></i>",array("class"=>"btn btn-sm btn-primary btn-print-grade","title"=>"print grade","data-toggle"=>"tooltip","data-placement"=>"top"))?>
    					<?php  echo ($scholar['info']->approved==0) ? ((($this->session->userdata("admin_id")||$this->session->userdata("super_admin_id"))&&!$lacks)?anchor("scholar/confirm/".$scholar['info']->aid,"<i class='fa fa-thumbs-up'></i>",array("class"=>"btn btn-sm btn-primary","title"=>"Approve","data-toggle"=>"tooltip","data-placement"=>"top")):"<span class='btn  btn-sm btn-primary disabled'  data-toggle='tooltip' data-placement='top' title='not confirmed'> <i class='fa fa-thumbs-up'></i></span>"): "<span class='btn  btn-sm btn-success disabled'  data-toggle='tooltip' data-placement='top' title='confirmed'> <i class='fa fa-thumbs-up'></i></span>"?>
    					</div>
    				</td>
    			</tr>
    			<?php
    				}
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
    	<?php echo form_close();?>
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
