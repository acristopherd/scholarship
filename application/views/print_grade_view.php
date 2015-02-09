<!DOCTYPE html>
<html>
	<head>
		<link href="<?php echo base_url()?>css/admin.bootstrap.min.css" rel="stylesheet">

		<style type="text/css">
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
				<p>Republic of the Philippines<br />
					<b>University of Northern Philippines</b><br />
					Vigan City</p>
			</div>
			<br />
			<table id = "stud-info">
				<tr><td><span class="fld-label">Name:</span><span class="values"><?php echo $student[0]->lname . ", " . $student[0]->fname ." " . $student[0]->mname ?></span></td><td><span class="fld-label">Course:</span><span class="values course"><?php echo $student[0]->course?></span></td></tr>
				<tr><td><span class="fld-label">Sem:</span><span class="values"><?php if(isset($grades[0]->sem))switch($grades[0]->sem) {case 1: echo "1st"; break; case 2: echo "2nd"; break; case 3: echo "Summer"; break; }?></span></td><td><span class="fld-label">School Year:</span><span class="values"><?php if(isset($grades[0]->sem))echo $grades[0]->school_year?></span></td></tr>
			</table>
			<table id="grades">
				<tr><th>Code</th><th>Description</th><th>Units</th><th>Midterm</th><th>Final</th><th>Remarks</th></tr>
				<?php 
				$min=0;
				foreach($grades as $grade){ 
				if($grade->fg>$min) $min=$grade->fg;	
				?>
				<tr>
					<td><?php echo $grade->sub_code ?></td>
					<td><?php echo $grade->sub_desc ?></td>
					<td><?php echo number_format((float)$grade->unit, 1, '.', '') ?></td>
					<td class="right"><?php echo number_format((float)$grade->mg, 2, '.', '') ?></td>
					<td class="right"><?php echo number_format((float)$grade->fg, 2, '.', '') ?></td>
					<td><?php echo (floatval($grade->fg)>3.00)?"Failed":"Passed" ?></td>
					
				</tr>
				<?php } ?>
								
			</table>
			<br />
			<div id ="ave" class="well well-sm"><span>Weighted Average:</span><span style="text-decoration:underline;font-weight:bold"><?php echo round($scholar_ave,2)?></span></div>
			<table id="legend">
				<tr><td>1.25-1.50 &ndash; Very Good</td>	<td>3.25-4.00 &ndash; Conditional</td>	<td>NFE &ndash; No Final Exam</td></tr>
				<tr><td>1.75-2.00 &ndash; Good</td>			<td>5.00 &ndash; Failed</td>			<td>NA &ndash; None Attendance</td></tr>
				<tr><td>2.25-2.50 &ndash; Average</td>		<td>INC &ndash; Incomplete</td></tr>
				<tr><td>2.75-3.00 &ndash; Fair</td>			<td>LR &ndash; Lacks Requirements</td></tr>
			</table>
			<br /><br />
			<table>
				<tr>
					<td><input type = "text" style = "text-align:center;width:100%" value = "<?php echo isset($signs[0]->adviser)?$signs[0]->adviser:"" ?>" readonly /></td>
					<td>&nbsp;</td>
					<td><input type = "text" style = "text-align:center;width:100%" value = "<?php echo isset($signs[0]->dean)?$signs[0]->dean:"" ?>" readonly /></td>
				</tr>
				<tr>
					<td class="sign"><i>Adviser</i></td>
					<td class="divider">&nbsp;</td>
					<td class="sign"><i>Dean</i></td>
				</tr>
			</table>
			<a href="#" class="btn btn-primary no-print" id ="btn-print" onclick="javascript:window.print()">Print</a>
			<div class="no-print">
				<div class="panel panel-info">
					<div class="panel-heading">
						Scholarship Information
					</div>
					<div class="panel-body">
						<table>
							<?php $passed=false;?>
							<tr><td>Sholarship</td><td><?php echo $scholar_type?></td></tr>
							<tr><td>Minimum</td><td><?php echo $min_grade?></td><td><?php echo $min ?></td><td><?php if( $min<=$min_grade&&$min!=0) {echo "OK";$passed=true; }else { echo "Failed"; $passed = false;} ?></td></tr>
							<tr><td>Average</td><td><?php echo $average?></td><td><?php echo $scholar_ave?></td><td><?php if( $scholar_ave<=$average&&$scholar_ave!=0) {echo "OK";$passed=true; }else { echo "Failed"; $passed = false;} ?></td></tr>
							<tr><td><?php echo $passed?anchor("scholar/print_cert_grade","Print Certificate of Grades",array("class"=>"btn btn-primary")):""?></td></tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	<script src="<?php echo base_url();?>js/jquery.js"></script>    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
	</body>
</html>

	
	