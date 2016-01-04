<?php $data['page_title'] = "Announcement View - Admin"; 
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
	<?php echo anchor("announcement","Back to Announcements",'class="btn btn-primary"')?>
	<ol class="breadcrumb">
        <li>
            <i class="fa fa-home"></i> <?php echo anchor("admin/","Home")?>
        </li>
        <li>
           <?php echo anchor("announcement/","View Announcements")?>
        </li>
        <li class="active"><?php echo $announcement->title?> </li>
        
    </ol>
    <h1> <?php echo $announcement->title?> </h1>
    <div class="well well-sm">
    	<div>From: <b><?php echo $announcement->from ?></b></div>
    	<div>Venue: <b><?php echo $announcement->venue ?></b></div>
    	<div>Time of Event: <b><?php echo $announcement->time_of_event ?></b></div>
    	<div>Date of Event: <b><?php echo $announcement->date_of_event ?></b></div>
    	<div>Date Posted: <b><?php echo $announcement->date_posted ?></b></div>
    </div>
    <div class ='well well-sm'>
		<?php echo  $announcement->message;
		?>
    </div>
</div>
   
<?php  $this->load->view('admin/includes/footer.php');
?>