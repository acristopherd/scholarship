<?php $page_title = "Messages View - Admin"; 
$style='<link href="'.base_url().'css/htmlarea/jHtmlArea.css" rel="stylesheet">
<style type="text/css">
	.message{
		height:2em;
		overflow:hidden;
		text-overflow:ellipsis;
	}
</style>'?>
<?php include("/../includes/header.php");?>

<div id="page-wrapper">
    <h1> Messages </h1>
    
    <div class="row">    	
    <div class="wrapper">
    <?php echo form_open("message/delete_all");?>
    <table class="table table-striped table-hover table-responsive" >
		<thead><tr class="table-header"><th>No</th><th>Title</th><th>Date</th><th>Author</th><th>Action</th></tr></thead>
		<tbody>
			<?php
			$no=1;
			foreach($messages as $message){
			?>
			<tr><td><?php echo form_checkbox(array("name"=>"selected[]"),$message->id) ?><?php echo $no++?></td>
				<td><?php echo anchor("message/view/".$message->id."/".rand(0, 9999),$message->subject) ?></td>    				
				<td><?php echo $message->date_posted ?></td>
				<td><?php echo $message->fname." ".$message->lname?></td>    				
				</td><td><?php echo anchor("message/delete"."/".$message->id,"<span class='btn btn-primary btn-circle btn-delete'><i class='fa fa-times' ></i></span>")?></td>
			</tr>
			
			<?php
			}
			?>
		</tbody>
    </table>
    <input type = "submit" value="Delete Selected" class="btn btn-primary" />
    <?php echo form_close()	?>
    </div>    	
    </div>
    </div>
   
<?php include("/../includes/footer.php");
?>
<script src="<?php echo base_url();?>js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("table").dataTable();
		$(".btn-delete").on("click",function(e){
			if(confirm("Delete this news?")==0){
				e.preventDefault();
			}
		});
		
	});
	$(function () {
	  $('[data-toggle="popover"]').popover()
	})
			
	
</script>