<html>
	<head>
		<title>Print Scholar</title>
		<style type="text/css">
			table,td,th{
				border:1px solid black;
				border-collapse:collapse;
				padding:.04in;
			}
			td{
				font-size:.9em;
			}
			
			.text-center{
				text-align:center;
			}
			.margin-auto{margin:auto}
			@media print{
				.no-print{
				display:none;
				}
			}
			
		</style>
	</head>
	<body>
	
<div id="page-wrapper">
	<p class="text-center">Republic of the Philippines<br>
		University of Northern Philippines<br>
		Heritage City of Vigan
	</p>
	<p class="text-center">Office of Student Affairs</p>
   
    <?php if(sizeof($scholars)>0){?>
    <h1 class="text-center"><?php echo $scholars[0]->course ?> Scholars</h1>
    <h5 class="text-center"><?php $word="";
			switch($scholars[0]->semester){
				case "1":	
					$word="1<sup>st</sup>";
					break;
				case "2":	
					$word="2<sup>nd</sup>";
					break;
				case "3":	
					$word="Summer";
					break;
			} echo $word ?> Semester - S.Y. <?php echo $scholars[0]->sy?> </h5>
    <a href="#" onclick="window.print()" class="no-print">Print</a>
    <div class = "row">    	    
    	<table class="margin-auto table table-striped table-hover table-responsive" id ="scholars-table">
    		<thead><tr class="table-header"><th></th><th>Name</th><th>Sex</th><th>Address</th><th>Scholarship</th><th>Year Level</th></tr></thead>
    		<tbody>
    			<?php
    			$no=1;    			
				
    			foreach($scholars as $scholar){
    				if($this->session->userdata("admin_id")||$this->session->userdata("super_admin_id")||$scholar['info']->coll_id==$this->session->userdata("college_id")){
    			?>	    			
    			<tr>
    				<td><?php  echo $no++?></td>
    				<td><div><?php echo $scholar->fname ?> <?php echo $scholar->mname?> <?php echo $scholar->lname ?></div></td>
    				<td><?php echo $scholar->gender ?></td>
    				<td><div><?php echo $scholar->brgy.", ".$scholar->town .", ".$scholar->prov ?></div></td>
    				<td><?php echo $scholar->type ?></td>
    				<td><?php echo $scholar->yr_level ?></td>
    			</tr>
    			<?php
    				}
    			}
				?>
    		</tbody>
    	</table>
    	
    	
    </div>
    <?php 
    }
	else{
	?>
	<div class="alert alert-danger">No records to show.</div>
	<?php	
	}
?>
</div>
	
	</body>
</html>
