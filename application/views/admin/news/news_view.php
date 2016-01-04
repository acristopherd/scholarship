<?php $data['page_title'] = "News View - Admin"; 
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
	<div class="container-fluid">
    <h1> News </h1>
    <hr>
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-home"></i> <?php echo anchor("admin/","Home")?>
        </li>
        <li class="active">View News</li>
    </ol>
    <div class="row-fluid">
    <a href="<?php echo site_url("news/add")?>" class = "btn btn-primary">Add New </a>
    </div>
    <hr>
    <div class="row-fluid">    	
    <div class="wrapper">
    	
    <table class="table table-striped table-hover table-responsive" >
    		<thead><tr class="table-header"><th>No</th><th>Title</th><th>Message</th><th>Date</th><th>Author</th><th>Posted On</th><th>Action</th></tr></thead>
    		<tbody>
    			<?php
    			$no=1;
    			foreach($newss as $news){
    			?>
    			<tr><td><?php echo $no++?></td><td><?php echo anchor("news/full_view/".$news->id.'/'.md5($news->id."r0sanne"),$news->title)?></td>
    				<td><?php echo str_replace("</div>", ' ',str_replace("<div>", ' ', substr($news->news,0,150))); if(strlen($news->news)>150) echo anchor("news/full_view/".$news->id.'/'.md5($news->id."r0sanne"),"...",'class="btn-xs fa btn-default"')?></td>
    				<td><?php echo $news->news_date ?></td></td><td><?php echo $news->author ?></td>
    				<td><?php echo $news->date_posted ?></td><td><?php echo anchor("news/delete"."/".$news->id,"<span class='btn btn-sm btn-primary btn-circle btn-delete'><i class='fa fa-times' ></i></span>")?></td></tr>
    			
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
			if(confirm("Delete this news?")==0){
				e.preventDefault();
			}
		});
		
		
	});
	
			
	
</script>