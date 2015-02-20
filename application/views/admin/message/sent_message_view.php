<?php $data['page_title'] = "Messages View - Admin"; 
$data['style']='<link href="'.base_url().'css/htmlarea/jHtmlArea.css" rel="stylesheet">
<style type="text/css">
	.message{
		height:2em;
		overflow:hidden;
		text-overflow:ellipsis;
	}
</style>'?>
<?php $this->load->view('admin/includes/header.php',$data);?>

<div id="page-wrapper">
    <h1> Sent </h1>
    
    <div class="row">    	
    <div class="wrapper">
    <?php echo form_open("message/delete_all_sent");?>
    <table class="table table-striped table-hover table-responsive" >
		<thead><tr class="table-header"><th>No</th><th>Title</th><th>Sent</th><th>To</th><th>Action</th></tr></thead>
		<tbody>
			<?php
			$no=1;
			foreach($messages as $message){
			?>
			<tr><td><?php echo form_checkbox(array("name"=>"selected[]","required"=>"required"),$message->id) ?><?php echo $no++?></td>
				<td><?php echo anchor("message/view_sent/".$message->id."/".rand(0, 9999),$message->subject) ?></td>    				
				<td><?php echo $message->date_posted ?></td>
				<td><?php 
				if($message->msg_type==2){
					echo $message->fname." ".$message->lname;
				}
				else if($message->msg_type==4){
					echo $message->sfname." ".$message->slname;
				}
				?></td>    				
				</td><td><?php echo anchor("message/delete_sent"."/".$message->id,"<span class='btn btn-primary btn-circle btn-delete'><i class='fa fa-times' ></i></span>")?></td>
			</tr>
			
			<?php
			}
			?>
		</tbody>
    </table>
    <input type = "submit" value="Delete Selected" class="btn btn-primary" id ="btn-delete-all" />
    <?php echo form_close()	?>
    </div>    	
    </div>
    </div>
   
<?php  $this->load->view('admin/includes/footer.php');
?>
<script src="<?php echo base_url();?>js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("table").dataTable();
		$(".btn-delete").on("click",function(e){
			
			if(confirm("Delete this message?")==0){
				e.preventDefault();
			}
		});
		
		$("#btn-delete-all").on("click",function(e){
			if(confirm("Delete selected message(s)?")==0){
				e.preventDefault();
			}
		});
		
	});
	$(function () {
	  $('[data-toggle="popover"]').popover()
	})
			
	
</script>