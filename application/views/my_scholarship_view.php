
<?php 
$title = "My Scholarship";
$link = '<link href="'.base_url().'fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css"><link href="'.base_url().'fancybox/helpers/jquery.fancybox-thumbs.css" rel="stylesheet" type="text/css">
	<style type="text/css">
	.fancybox img{
		width:100px;
	}
	</style>
';

include("includes/header.php"); ?>
<section class = "container main-container">
	
	<div class="wrapper col-lg-6 col-lg-offset-1 col-md-6 col-md-offset-1 col-sm-8 col-sm-offset-1 col-xs-10 col-lg-offset-1">
		<h3>Scholarship Applications</h3>
	<?php
	foreach($scholarships as $scholarship){
	?>
		<div class = "scholarship panel panel-success">
			<div class = "panel-heading"><i class="fa fa-archive"></i>
				<b><?php 
				$sem="";
				switch($scholarship->semester){
					case 1:
						$sem= "1st Sem";
						break;
					case 2:
						$sem= "2nd Sem";
						break;
					case 3:
						$sem= "Summer";
						break;
				}
				 echo $sem . " - ". $scholarship->sy;
				 ?> 
				 </b>
			</div>
			<div class="panel-body">
				<div class ="wrapper"><b><?php echo $scholarship->type ?></b></div>
				<div class ="wrapper"><span class="">No of Units:</span><i><?php echo $scholarship->no_of_units ?></i></div>
				<div class ="wrapper"><span class="">No of Subjects:</span><i><?php echo $scholarship->no_of_subjects ?></i></div>
				<span class="">Requirements:</span>
				<?php				
				foreach ($requirements[$scholarship->aid] as $requirement){					
				?>	
					<div><?php foreach($requirement as $r) {
						echo '<a class="fancybox" href="'.base_url().'requirements/'.$r->file_name.'"><img src="'.base_url().'requirements/'.$r->file_name.'" /></a>';
						?>
						
						<?php	
						}
						?></div>
				<?php	
				}
				?>
			</div>
		</div>
	<?php
	}
	?>
	</div>
</section>

<?php include("includes/footer.php"); ?>
<script src="<?php echo base_url();?>fancybox/jquery.fancybox.js"></script>
<script src="<?php echo base_url();?>fancybox/jquery.fancybox.pack.js"></script>
<script src="<?php echo base_url();?>fancybox/helpers/jquery.fancybox-thumbs.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox();
	});
</script>