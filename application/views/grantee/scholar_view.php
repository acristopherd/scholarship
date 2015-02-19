<?php $data['page_title'] = "Scholar View - Grantee"; 
$data['style'] = '<style type = "text/css">
			.requirement{
				max-width:8em;
				text-overflow:ellipsis;
				overflow:hidden;
			}
			</style>'?>
<?php $this->load->view("includes/header.php",$data); ?>
<div class="container main-container">
    <h1> Scholars [<?php echo $scholars[0]['info']->type?>]</h1>
    
    <?php if(sizeof($scholars)>0){?>
    <div class = "row">   
    	<table class="table table-striped table-hover table-responsive" id ="scholars-table">
    		<thead><tr class="table-header"><th>No</th><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Sex</th><th>Town</th><th>Requirements</th><th>Status</th></tr></thead>
    		<tbody>
    			<?php
    			$no=1;    			
    			foreach($scholars as $scholar){
    			?>
    			<tr>
    				<td><?php  echo $no++?></td>
    				<td><?php echo $scholar['info']->fname ?></td><td><?php echo $scholar['info']->mname?></td>
    				<td><?php echo $scholar['info']->lname ?></td><td><?php echo $scholar['info']->gender ?></td><td><?php echo $scholar['info']->town ?></td>
    				<td>
    					<a href = "<?php echo $scholar['info']->average>0?site_url("scholar/view_grade/".$scholar['info']->aid):"#"?>" class="requirement btn btn-sm btn-<?php echo $scholar['info']->average>0? "success": "danger disabled";?>"
    						title = "<?php echo $scholar['info']->average>0? "Weighted Average": "Not yet submitted.";?>" data-toggle="tooltip" data-placement="top"> <?php echo $scholar['info']->average?number_format($scholar['info']->average,2):"Ave" ?></a>
    					<?php     				
	    				foreach($scholar['requirements'] as $requirement){
	    				?>
	    				<a href = "<?php echo empty($requirement->file_name)?"#":base_url()."requirements/".$requirement->file_name ?>" class="requirement btn btn-sm btn-<?php echo empty($requirement->file_name)? "danger disabled": "success";?>"
	    					title = "<?php echo $requirement->requ_name ?>"  data-toggle="tooltip" data-placement="top"><?php echo $requirement->requ_name ?></a>
	    				<?php
	    				}     				
	    				?>
	    			</td>
	    			<td><?php echo $scholar['info']->approved==1?"Approved":"Pending"?></td>
    				
    			</tr>
    			<?php
    			}
				?>
    		</tbody>
    	</table>
    	
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
<?php $this->load->view("includes/footer.php");?>
 <script src="<?php echo base_url();?>js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url();?>js/plugins/dataTables/dataTables.bootstrap.js"></script>

   
    <script>
    $(document).ready(function() {
        $('#scholars-table').dataTable();
         $('[data-toggle="tooltip"]').tooltip();  
         $("#check-all").click(function(){
         	$(".chk-approv").attr("checked","checked");
         });
    });
    </script>
