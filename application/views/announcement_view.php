
<?php 
$style='<style type = "text/css">
	.details{
		font-size:1em;
	}
	.details div{
		border-bottom:1px solid #ddd;
		margin-bottom:.5em;
	}
	.details{
		padding:0 1em;
		background-color:#abf;
	}
	.h3{
		text-transform:capitalize;font-weight:700;margin:0 1em .5em 1em;
	}
	.date-posted{
		font-size:.7em;
	}
	
	.affix li{
		text-transform:capitalize;
	}
</style>';
$title="Announcements";
include("includes/header.php");?>
<header class="" id = "overview">
	<div class="container main-header">
		<h1 class="h1">Announcements</h1>
		<p>View Announcements</p>
	</div>
</header>
<div class="container main-container">
	<div class="span3">
		<ul class="nav nav-list affix">
			<li class="nav-header">Titles</li>
		<?php 
		$total=0;
		foreach($announcements as $announcement){
		?>
		
		  
		  <li class=""><a href="#<?php echo $announcement['all']->title?>"><?php echo $announcement['all']->title?> </a></li>
		 
		
		<?php
		if($total++>=15) break;	
		}
		?>
		</ul>
	</div>
	<div class = "container span6 col-md-8">
	<?php foreach($announcements as $announcement){
	?>
	<a name="<?php echo $announcement['all']->title ?>"></a>
	<a name="<?php echo $announcement['all']->id ?>"></a>
	
	<div class="card">
		
		<div class="card-top green">
			
			<h3  class="h3 "><?php echo $announcement['all']->title ?></h3>					
		</div>
		<div class="card-heading-header alert-info">
			
			<div class= "details ">
				<div class=""><b>Date:</b> <i class="msg-date"><?php echo mdate('%M %d, %Y',human_to_unix($announcement['all']->date_of_event)) ?></i></div>
				
				<div><b>Time:</b> <i class="msg-time"><?php echo $announcement['all']->time_of_event ?></i></i></div>
				
				<div><b>Venue:</b> <i class="msg-venue"><?php echo $announcement['all']->venue ?></i></div>
				
				<div><b>By:</b> <i class="msg-from"><?php echo $announcement['all']->from ?></i></div>
			</div>
		</div>
		<div class="card-body">
			<div class="message"><?php echo $announcement['all']->message ?></div>
		</div>
		<div class="card-comments">
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
	<div class="pagination">
			<?php echo $links ?>
		</div>
	</div>
	
	<div class="container span12 col-md-12 col-sm-12">
		&nbsp;
		
	</div>
</div>
	
<?php include("includes/footer.php");?>
<script type="text/javascript">
	$(document).ready(function() {
		$(".pagination-links a").addClass("btn btn-warning");
		$(".pagination-links strong").addClass("btn btn-primary");
		$("#nav-announcement").addClass("active");
	});

</script>