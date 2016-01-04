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
	<?php echo anchor("news","Back to News",'class="btn btn-primary"')?>
	<ol class="breadcrumb">
        <li>
            <i class="fa fa-home"></i> <?php echo anchor("admin/","Home")?>
        </li>
        <li>
           <?php echo anchor("news/","News")?>
        </li>
        <li class="active"><?php echo $news->title?> </li>
        
    </ol>
    <h1> <?php echo $news->title?> </h1>
    <div class="well well-sm">
    	<div>Author:<b><?php echo $news->author ?></b></div>
    	<div>Date:<b><?php echo $news->date_posted ?></b></div>
    </div>
    <div class ='well well-sm'>
		<?php echo  $news->news;
		?>
    </div>
</div>
   
<?php  $this->load->view('admin/includes/footer.php');
?>