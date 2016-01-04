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
$title="News";
?>
<?php 

require_once("includes/header.php");
?>
<header class="" id = "overview">
	<div class="container main-header">
		<h1 class="h1">News</h1>
		<p>View News</p>
	</div>
</header>
<div class="container main-container">
	
	<div class = "container-fluid">
		<div class="news1 span5"></div>
		<div class="news2 span5"></div>
		<div class="news-all">
	<?php  foreach($newss as $news){
	?>
	<div class="card">
		<div class="card-heading image">
			<img src="<?php echo base_url()?>/images/user.png">
			<div class="card-heading-header">		
			<h3 class=""><strong><?php echo $news['info']->title ?></strong></h3>
				
			<span>
			<b>By:</b> <i class="msg-from"><?php echo $news['info']->author ?> on </i><i class="msg-date"><?php echo mdate('%F %d, %Y',human_to_unix($news['info']->news_date)) ?></i>
			</span>	
			</div>							
		</div>
		<hr>
		<div class="card-media">
			<?php
			$firstpic=true;
			foreach($news["pics"] as $pic){
			?>
				<a class="fancybox" href="<?php echo base_url()."news/".$pic->loc?>"><img width="<?php echo ($firstpic?"100%":"");?>" src="<?php echo base_url()."news/".($firstpic?"cards/":"thumbs/").$pic->loc?>" /></a>
			<?php
			$firstpic=false;}
			?>
			</div>
		<div class="card-body">
			
				
				
			
			<p class="message"><?php echo $news['info']->news ?></p>
		</div>
		<div class="card-comments">
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
	</div>
	<div class="container-fluid span12 col-md-12 col-sm-12">
		<div class="pagination">
			<?php echo $links ?>
		</div>
	</div>
	<div class="container span12 col-md-12 col-sm-12">
		&nbsp;
		
	</div>
</div>
	
<?php include("includes/footer.php");?>
<script src="<?php echo base_url();?>fancybox/jquery.fancybox.js"></script>
<script src="<?php echo base_url();?>fancybox/jquery.fancybox.pack.js"></script>
<script src="<?php echo base_url();?>fancybox/helpers/jquery.fancybox-thumbs.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox();
		$(".pagination-links a").addClass("btn btn-warning");
		$(".pagination-links strong").addClass("btn btn-primary");
		var odd=true;
		$(".news-all .card").each(function (index,elem){
			if (odd){
				$(".news1").append($(elem));
			}
			else{
				$(".news2").append($(elem));
			}
			odd=!odd;
			
		});
		$("#nav-news").addClass("active");
		//$("#myCarousel .carousel-inner").append($("<div></div>).addClass("item").append($(title)).append($(hr)).append($(announcement)).append($(hr).clone()).append($(from)));
				
	});

</script>