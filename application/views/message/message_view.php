<?php $data['page_title'] = "Messages View - Admin"; 
$data['style']='<link href="'.base_url().'css/htmlarea/jHtmlArea.css" rel="stylesheet">
<style type="text/css">
	.message{
		height:2em;
		overflow:hidden;
		text-overflow:ellipsis;
	}
	th{
		background:#4387f5;color:#efefff;
		border-bottom: 2px solid #4387f5;
		cursor:pointer;
	}
	th:hover{
		border-bottom-color: #eef;
	}
</style>'?>
<?php $this->load->view('includes/header.php',$data);?>

<div class="container main-container">
	<header class="" id = "overview">
	<div class="container main-header">
		<h1 class="h1">Inbox</h1>
		<p><a href = "<?php echo site_url("message/inbox")?>" class="btn btn-primary"><i class="fa fa-refresh"></i> Refresh</a></p>
	</div>
</header>
    
    <section class="container-fluid">    	
    <div class="wrapper span10">
    <?php echo form_open("message/delete_all");?>
    <table class="table table-striped table-hover table-responsive" >
		<thead><tr class="table-header"><th>No</th><th>Title</th><th>Sent</th><th>From</th><th>Action</th></tr></thead>
		<tbody>
			<?php
			$no=1;
			foreach($messages as $message){
			?>
			<tr><td><?php echo form_checkbox(array("name"=>"selected[]","required"=>"required"),$message->id) ?> <?php echo $no++?></td>
				<td><?php echo $message->msg_read==1?anchor("message/view/".$message->id."/".rand(0, 9999),$message->subject):"<b>".anchor("message/view/".$message->id."/".rand(0, 9999),$message->subject)."</b>" ?></td>    				
				<td><?php echo $message->date_posted ?></td>
				<td><?php echo $message->from_name." - ".$message->from_desc?></td>    				
				</td><td><?php echo anchor("message/delete"."/".$message->id,"<span class='btn btn-primary btn-circle btn-delete'><i class='fa fa-times' ></i></span>")?></td>
			</tr>
			
			<?php
			}
			?>
		</tbody>
    </table>
    <input type = "submit" value="Delete Selected" class="btn btn-primary" id ="btn-delete-all" />
    <?php echo form_close()	?>
    </div>    	
    </section>
    </div>
   
<?php  $this->load->view('includes/footer.php');
?>
<script src="<?php echo base_url();?>js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("table").dataTable();
		$(".row").addClass("row-fluid").removeClass("row");
		$(".col-sm-6").addClass("span6");
		$("ul.pagination").parent().addClass("pagination");
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