<?php $page_title = "Announcement View - Admin"; 
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
    <h1> Announcements </h1>
    <a href="<?php echo site_url("announcement/add")?>" class = "btn btn-primary">Add New </a>
    <div class="row">    	
    <div class="wrapper">
    	
    <table class="table table-striped table-hover table-responsive" >
    		<thead><tr class="table-header"><th>No</th><th>Title</th><th>Message</th><th>Date</th><th>Venue</th><th>From</th><th>Posted On</th><th>Action</th></tr></thead>
    		<tbody>
    			<?php
    			$no=1;
    			foreach($announcements as $announcement){
    			?>
    			<tr><td><?php echo $no++?></td><td><?php echo $announcement->title?></td><td><a class="message btn" data-toggle="popover" tabindex="<?php echo $no?>" role="button" data-trigger="focus"  title="Message" data-content="<?php echo strip_tags($announcement->message)?>"><?php echo strtok(strip_tags($announcement->message)," ")."..."?></a></td>
    				<td><?php echo $announcement->date_of_event ?></td><td><?php echo $announcement->venue ?></td><td><?php echo $announcement->from ?></td>
    				<td><?php echo $announcement->date_posted ?></td><td><?php echo anchor("announcement/delete"."/".$announcement->id,"<span class='btn btn-primary btn-circle btn-delete'><i class='fa fa-times' ></i></span>")?></td></tr>
    			
    			<?php
    			}
				?>
    		</tbody>
    	</table>
    	
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
			if(confirm("Delete this announcement?")==0){
				e.preventDefault();
			}
		});
		
	});
	$(function () {
	  $('[data-toggle="popover"]').popover()
	})
			
	
</script>