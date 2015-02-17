
<?php 
$style='<style type = "text/css">
	.details{
		font-size:.7em;
	}
	.date-posted{
		font-size:.7em;
	}
</style>';
include("includes/header.php");?>
<section class="container main-container">
	<h1>Announcements</h1>
	<div class = "container col-lg-6 col-md-8">
	<?php foreach($announcements as $announcement){
	?>
	<a name="<?php echo $announcement['all']->id?>"></a>
	<div class="panel panel-info">
		
		<div class="panel-heading">
			<div class="row">
				<div class="col-lg-2 col-md-2 col-xs-2"><i class = "fa fa-bullhorn fa-4x"></i></div>			
				<div class="col-lg-7 col-md-7  col-xs-10">
					<h3><?php echo $announcement['all']->title ?></h3>				
					
				</div>
				<div class= "col-lg-3 col-md-3 details">
					<div><b>Date:</b> <i class="msg-date"><?php echo mdate('%M %d, %Y',human_to_unix($announcement['all']->date_of_event)) ?></i></div>
					<div><b>Time:</b> <i class="msg-time"><?php echo $announcement['all']->time_of_event ?></i></i></div>
					<div><b>Venue:</b> <i class="msg-venue"><?php echo $announcement['all']->venue ?></i></div>
					<div><b>By:</b> <i class="msg-from"><?php echo $announcement['all']->from ?></i></div>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<div class="message"><?php echo $announcement['all']->message ?></div>
		</div>
		<div class="panel-footer">
			<i class="date-posted">Posted: <?php 
			$sec_ago=human_to_unix($announcement['all']->date_posted);
			$sec_from_post=human_to_unix(mdate("%Y-%m-%d %h:%i:%s"))-$sec_ago;
			if($sec_from_post<(3600*24)){
				echo timespan($sec_ago)." ago.";
			} 
			else if($sec_from_post<(3600*24*2)){
				echo "Yesterday at ".mdate('%h:%m:%s %A',$sec_ago);
			}
			else{
				echo mdate('%M %d, %Y at %h:%m:%s %A',$sec_ago);
			}
			
			
			 ?></i>
		</div>
	</div>
	<?php
	
	}
	?>
	</div>
	<div class="container col-lg-12 col-md-12 col-sm-12">
		<div class="btn-group pagination-links">
			<?php echo $links ?>
		</div>
	</div>
	<div class="container col-lg-12 col-md-12 col-sm-12">
		&nbsp;
		
	</div>
</section>
	
<?php include("includes/footer.php");?>
<script type="text/javascript">
	$(document).ready(function() {
		$(".pagination-links a").addClass("btn btn-warning");
		$(".pagination-links strong").addClass("btn btn-primary");
	});

</script>