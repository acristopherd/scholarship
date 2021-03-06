<?php $data['page_title'] = "Announcement View - Admin"; 
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
	<div class="containter-fluid">
    <h1> Announcements Archive </h1>
    <hr>
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-home"></i> <?php echo anchor("admin/","Home")?>
        </li>
        <li class="active">Announcements Archive</li>
    </ol>
    <div class="row-fluid">    	
    <div class="wrapper">
    	
    <table class="table table-striped table-hover table-responsive" >
    		<thead><tr class="table-header"><th>No</th><th>Title</th><th>Message</th><th>Date</th><th>Venue</th><th>From</th><th>Posted On</th></tr></thead>
    		<tbody>
    			<?php
    			$no=1;
    			foreach($announcements as $announcement){
    			?>
    			<tr><td><?php echo $no++?></td><td><?php echo anchor("announcement/archive_full_view/".$announcement->id.'/'.md5($announcement->id."r0sanne"),$announcement->title)?></td>
    				<td><?php echo str_replace("</div>", ' ',str_replace("<div>", ' ', substr($announcement->message,0,150))); if(strlen($announcement->message)>150) echo anchor("announcement/full_view/".$announcement->id.'/'.md5($announcement->id."r0sanne"),"...",'class="btn-xs fa btn-default"')?></td>
    				<td><?php echo $announcement->date_of_event ?></td><td><?php echo $announcement->venue ?></td><td><?php echo $announcement->from ?></td>
    				<td><?php echo $announcement->date_posted ?></td>
    			</tr>
    			
    			<?php
    			}
				?>
    		</tbody>
    	</table>
    	
    </div>    	
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
			if(confirm("Archive this announcement?")==0){
				e.preventDefault();
			}
		});
		
	});
	$(function () {
	  $('[data-toggle="popover"]').popover()
	})
			
	
</script>