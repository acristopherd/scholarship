<!DOCTYPE html>
<html>
	<head>
		<link href="<?php echo base_url()?>css/admin.bootstrap.min.css" rel="stylesheet">

		<style type="text/css">
			.page-wrapper{
				width:6.5in;
				margin: 1in auto;
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
				display: relative;
			}
			.grade-header table{width:22em}
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
			#sign{width:25em;text-align:right}
			#dean{text-transform:uppercase;font-weight:bold;text-decoration:underline}
			img{
				height:4em;
			}
			
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
				<table><tr><td><img style="float:right" src = "<?php echo base_url() ?>images/unpv1.png" /></td>
				<td><pstyle="float:left">Republic of the Philippines<br />
				<b>University of Northern Philippines</b><br />
				Vigan City</p></td>
				</tr>
				</table>
			</div>
			<br />
			<p style="text-transform:uppercase;text-align:center"><b><?php echo $scholar[0]->college_name?></b></p>
			<p style="text-transform:uppercase;text-align:center;font-size: 2em"><b>CERTIFICATION</b></p>
			<br />
			<p style="line-height:2em">To Whom It May Concern:</p>
			<br />
			<p style="text-indent:5em;line-height: 2em;text-align: justify">
				This is to certify that <span class="bold"><?php echo $scholar[0]->fname ." ".$scholar[0]->mname." ". $scholar[0]->lname?></span> 
				a <?php 
				switch($scholar[0]->yr_level){
					case 1:
						echo "1st";
						break;
					case 2:
						echo "2nd";
						break;
					case 3:
						echo "3rd";
						break;
					case 4:
						echo "4th";
						break;
					case 5:
						echo "5th";
						break;
				} 
				?> Year <?php echo $scholar[0]->course_name?> of the 
				<span style = "text-transform: capitalize"><?php echo $scholar[0]->college_name?></span> obtained a grade of 
				<span class="bold"><?php echo number_format($scholarship[0]->average,2) ?></span> during the <?php 
				switch($grade[0]->sem){
					case 1:
						echo "1st Semester";
						break;
					case 2:
						echo "2nd Semester";
						break;
					case 3:
						echo "Summer";
						break;
				} 
				?> of school year <?php echo $grade[0]->school_year?>. Therefore <?php echo $scholar[0]->gender=="Male"?"he":"she"?> is considered/qualified to be a
				 <span class="bold"><?php echo $scholarship[0]->type?></span>.
			</p>
			<br />
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

	
	