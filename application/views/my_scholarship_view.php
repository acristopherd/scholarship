
<?php 
$title = "My Scholarship";
$link = '<link href="'.base_url().'fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css"><link href="'.base_url().'fancybox/helpers/jquery.fancybox-thumbs.css" rel="stylesheet" type="text/css">
	<style type="text/css">
	.fancybox img{
		width:100px;
	}
	.requirements li{padding:5px !important;}
	</style>
';

include("includes/header.php"); ?>
<header class="" id = "overview">
	<div class="container main-header">
		<h1>My Scholarship Applications</h1>
		<p>List of Scholarship Applications</p>
	</div>
</header>

<div class = "container main-container">
	
	<div class="wrapper span6 spanoffset-1 col-md-6 col-md-offset-1 col-sm-8 col-sm-offset-1 col-xs-10 spanoffset-1">
		
	<?php
	foreach($scholarships as $scholarship){
	?>
		<div class = "scholarship card">
			<h3 class = "card-heading simple"><i class="fa fa-archive"></i>
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
				</b> - <i><?php echo $scholarship->approved==1?"Approved":"Pending"?></i>
			</h3>
			<div class="card-body">
				<div class ="wrapper"><b><?php echo $scholarship->type ?></b></div>
				<div class ="wrapper"><span class="">No of Units:</span><i><?php echo $scholarship->no_of_units ?></i></div>
				<div class ="wrapper"><span class="">No of Subjects:</span><i><?php echo $scholarship->no_of_subjects ?></i></div>
				
				<?php				
				foreach ($requirements[$scholarship->aid] as $requirement){					
				//print_r( $requirement);?>	
					<div class="row-fluid">
						
						<ol class="nav nav-tabs nav-stacked">
							<li class="nav-header">Requirements:</li>
						<?php foreach($requirement as $r) { ?>
						<li>
						<?php
						if($r->file_name!=null){
						?><a class="fancybox" href="<?php echo base_url()."requirements/".$r->file_name?>" title ="<?php echo $r->requ_name?>">
							<?php 
							if(strpos($r->file_name,'pdf') !== false)
							echo '<img src="'.base_url().'requirements/'.$r->file_name.'" />';
							else 
							echo '<div class="">'.$r->requ_name.'</div>';
							?>
							</a>
						<?php	
						}
						else{
							echo form_open_multipart("scholar/late_requirement/".$scholarship->aid,'class="form"');
							echo form_hidden("scholarhship_id",$scholarship->aid);
							echo form_hidden("req_id",$r->id);
							echo form_label($r->requ_name,"requirement","class='form-label'");
							echo form_upload(array("name"=>"requirement","required"=>"required","class"=>"form-control input-sm","accept"=>"image/*"));
							echo form_submit(array("class"=>"btn btn-info btn-sm"),ucwords("submit"));
							echo form_close();
						}
						?>
						</li>
						
						
						<?php
						}
						?>
						</ol></div>
				<?php	
				}
				?>
			</div>
		</div>
	<?php
	}
	?>
	</div>
</div>

<?php include("includes/footer.php"); ?>
<script src="<?php echo base_url();?>fancybox/jquery.fancybox.js"></script>
<script src="<?php echo base_url();?>fancybox/jquery.fancybox.pack.js"></script>
<script src="<?php echo base_url();?>fancybox/helpers/jquery.fancybox-thumbs.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox();
	});
</script>