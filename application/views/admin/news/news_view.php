<?php $page_title = "News View - Admin"; 
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
    <h1> News </h1>
    <a href="<?php echo site_url("news/add")?>" class = "btn btn-primary">Add New </a>
    <div class="row">    	
    <div class="wrapper">
    	
    <table class="table table-striped table-hover table-responsive" >
    		<thead><tr class="table-header"><th>No</th><th>Title</th><th>Message</th><th>Date</th><th>Author</th><th>Posted On</th><th>Action</th></tr></thead>
    		<tbody>
    			<?php
    			$no=1;
    			foreach($newss as $news){
    			?>
    			<tr><td><?php echo $no++?></td><td><?php echo $news->title?></td><td><a class="message btn" data-toggle="popover" tabindex="<?php echo $no?>" role="button" data-trigger="focus"  title="Message" data-content="<?php echo strip_tags($news->news)?>"><?php echo strtok(strip_tags($news->news)," ")."..."?></a></td>
    				<td><?php echo $news->news_date ?></td></td><td><?php echo $news->author ?></td>
    				<td><?php echo $news->date_posted ?></td><td><?php echo anchor("news/delete"."/".$news->id,"<span class='btn btn-primary btn-circle btn-delete'><i class='fa fa-times' ></i></span>")?></td></tr>
    			
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
			if(confirm("Delete this news?")==0){
				e.preventDefault();
			}
		});
		
	});
	$(function () {
	  $('[data-toggle="popover"]').popover()
	})
			
	
</script>