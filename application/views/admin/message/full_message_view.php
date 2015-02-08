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
	<div class="wrapper">
		<a href = "<?php echo site_url("message")?>" class="btn btn-default">Back to Messages	</a>
	</div>
	<div class="wrapper">
		<p>From:<strong><?php echo $messages[0]->fname.$messages[0]->lname ?></strong> on <i><?php echo $messages[0]->date_posted ?> </i></p>
	</div>
	
    <h3> <?php echo $messages[0]->subject ?> </h3>
    
    <div class="wrapper">    	
    	<p class="well">
    		<?php echo $messages[0]->message ?> </h3>
    	</p>
    	<?php if (sizeof($attachments)>0){?>
    	<div class="panel panel-default">
    		<div class="panel-heading">
    			Attachments
    		</div>
    		<div class="panel-body">
    			<?php
    			$no=1; 
    			foreach($attachments as $attachment){
    				echo anchor(base_url()."attachment/".$attachment->loc,"attachment_".$no++);
    			}
				?>
    		</div>
    	</div>
    	<?php }?>
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