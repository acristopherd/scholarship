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
<header class="" id = "overview">
	<div class="container main-header">
		<h1 class="h1">About</h1>
		<p>Office of Student Affairs - University of Northern Philippines</p>
	</div>
</header>
<div class="container main-container">
	
	<section class="span6">
		<h2>Vision</h2>
		<hr>
		<p>
			A world class university anchored on excellence.
		</p>
	</section>
	
	<section class="span6">
		<h2>Mission</h2>
		<hr>
		<p>
			Mission of UNP.
		</p>
	</section>
	
	<section class="span6">
		<h2>Goals</h2>
		<hr>
		<p>
			Goals of the office.
		</p>
	</section>
	
	<section class="span6">
		<h2>Objectives</h2>
		<hr>
		<p>
			Objectives of the office.
		</p>
	</section>
	
	<section class="span6">
		<h2>Organizational Structure</h2>
		<hr>
		<p>
			A picture here.
		</p>
	</section>
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
		
		$("#nav-about").addClass("active");
	});

</script>