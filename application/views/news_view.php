<?php
$link = '<link href="'.base_url().'fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css">
<link href="'.base_url().'fancybox/helpers/jquery.fancybox-thumbs.css" rel="stylesheet" type="text/css">';
$style="<style type = \"text/css\">
	.details{
		font-size:.7em;
	}
	.date-posted{
		font-size:.7em;
	}
	.fancybox .image{
		max-height:70%;
		display:none;
	}
</style>";
?>
<?php 

require_once("includes/header.php");
?>
<section class="container main-container">
	<h1>News</h1>
	<div class = "container col-lg-6">
	<?php  foreach($newss as $news){
	?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><i class = "fa fa-th-list fa-4x"></i></div>			
				<div class="col-lg-7 col-md-7  col-sm-7 col-xs-10">
					<h3><?php echo $news['info']->title ?></h3>		
				</div>
			</div>
		</div>
		<div class="panel-body">
			
				<div class="">
					<div><b>By:</b> <i class="msg-from"><?php echo $news['info']->author ?> on </i><i class="msg-date"><?php echo mdate('%F %d, %Y',human_to_unix($news['info']->news_date)) ?></i></div>
				</div>
				
			<hr />
			<?php
			foreach($news["pics"] as $pic){
			?>
				<a class="fancybox" href="<?php echo base_url()."news/".$pic->loc?>"><img src="<?php echo base_url()."news/thumbs/".$pic->loc?>" /></a>
			<?php
			}
			?>
			<hr />
			<div class="message"><?php echo $news['info']->news ?></div>
		</div>
		<div class="panel-footer">
			<i class="date-posted">Posted: <?php 
			$sec_ago=human_to_unix($news['info']->date_posted);
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
<script src="<?php echo base_url();?>fancybox/jquery.fancybox.js"></script>
<script src="<?php echo base_url();?>fancybox/jquery.fancybox.pack.js"></script>
<script src="<?php echo base_url();?>fancybox/helpers/jquery.fancybox-thumbs.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox();
		$(".pagination-links a").addClass("btn btn-warning");
		$(".pagination-links strong").addClass("btn btn-primary");
	});

</script>