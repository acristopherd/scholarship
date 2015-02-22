<?php $data['page_title'] = "Messages View - Admin"; 
$data['style']='<link href="'.base_url().'css/htmlarea/jHtmlArea.css" rel="stylesheet">
<style type="text/css">
	.message{
		height:2em;
		overflow:hidden;
		text-overflow:ellipsis;
	}
</style>'?>
<?php  $this->load->view('admin/includes/header.php',$data);?>

<div id="page-wrapper">
	<div class="wrapper">
		<a href = "<?php echo site_url("message/inbox")?>" class="btn btn-default">Back to Messages	</a>
	</div>
	<br>
	<div class="wrapper">
		<p>From: <strong><?php echo $messages[0]->from_name ?></strong> (<?php echo $messages[0]->from_desc?>) on <i><?php echo  date('F d, Y h:i:s a',human_to_unix($messages[0]->date_posted)) ?> </i></p>
	</div>
	<strong>Subject:</strong><br />
    <div class="well well-sm"> <?php echo $messages[0]->subject ?> </div>
    
    <div class="wrapper">   
    	<strong>Message:</strong><br /> 	
    	<p class="well">
    		
    		<?php echo $messages[0]->message ?> </h3>
    	</p>
    	<?php if (sizeof($attachments)>0){?>
    	<div class="panel panel-default">
    		<div class="panel-heading">
    			Attachment(s)
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
    	<a href ="<?php echo site_url("message/reply/".$messages[0]->msg_from."/".$messages[0]->msg_type."/".$messages[0]->from_name ."/".$messages[0]->subject)?>" class="btn btn-default">Reply</a>
    
    </div>
</div>
   
<?php $this->load->view('admin/includes/footer.php');
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