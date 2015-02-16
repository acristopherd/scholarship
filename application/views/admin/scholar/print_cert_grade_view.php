<!DOCTYPE html>
<html>
	<head>
		<link href="<?php echo base_url()?>css/admin.bootstrap.min.css" rel="stylesheet">

		<style type="text/css">
			.page-wrapper{
				width:6.5in;
				margin:auto;
			}
			p{
				text-indent:5em;
			}
			#grades,#grades td,#grades th{
				border:1px solid black;
				border-collapse: collapse;
				padding:.1em 1em;
			}
			#legend{
				font-size:.8em;
			}
			#stud-info td{
				width:50%;
				padding:.3em;
			}
			table{
				width:6.5in;
				margin:auto;
			}
			#ave{
				width:6.5in;
				margin:auto;
			}
			.values{
				padding: .02em 1em;
				border-bottom:1px solid black;
			}
			.grade-header{
				text-align:center;
			}
			.sign{
				border-top:1px solid black;
				text-align:center;
				width:33%;
			}
			.right{
				text-align:right;
			}
			.page-wrapper{
				background-color:#FFF;
			}
			.fld-label{
				font-weight:bold;
			}
			.divider{width:10%}
			.course{font-family:arial,sans-serif;text-overflow:ellipses;padding:1px;height:1em;font-strectch:condense}
			input[type="text"]{
				text-transform:uppercase;
				font-weight:bold;
			}
			.bold{font-weight: bold}
			.underline{text-decoration:underline}
			#sign{}
			#dean{text-transform:uppercase;font-weight:bold;text-decoration:underline}
			@media print{
				footer{display:none}
				input{border:none;text-transform:uppercase;font-weight:bold;overflow:visible;width:150%}
				td{overflow:visible}
				.no-print{display:none}
			}
		</style>
	</head>
	<body>
		<div class="page-wrapper ">
			
			<div class="grade-header">
				Republic of the Philippines<br />
					<b>University of Northern Philippines</b><br />
					Vigan City
			</div>
			<br />
			<p>
				This is to certify that <span class="bold underline"><?php echo $scholar[0]->fname ." ".$scholar[0]->mname." ". $scholar[0]->lname?></span> is qualified to be a
				 <span class="bold underline"><?php echo $scholarship[0]->type?></span> in our college 
				with an average of <span class="bold underline"><?php echo $scholarship[0]->average ?></span>.
			</p>
			<p id = "sign">
				<div id = "dean"><?php echo $scholar[0]->dean?></div>
				<div>Dean <?php echo $scholar[0]->college?></div>
			</p>
			<div class="no-print">
				<a href="#" class="btn btn-primary"  onclick="javascript:window.print()">Print</a>
			</div>
			
		</div>
	<script src="<?php echo base_url();?>js/jquery.js"></script>    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
    
	</body>
</html>

	
	