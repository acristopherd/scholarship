<html>
	<head>
		<title>Print Scholar</title>
		<style type="text/css">
			table,td,th{
				border:1px solid black;
				border-collapse:collapse;
				padding:.04in;
			}
			@media print{
				.no-print{
				display:none;
				}
			}
			.header{
				text-align:center;
			}
			.strong{font-weight:bold}
			.osa{text-transform:uppercase}
		</style>
	</head>
	<body>
	
<div id="page-wrapper">
	<div class="header">
		<p>Republic of the Philippines<br>
		<span class="strong">University of Northern Philippines</span><br>
		Vigan City</p>
		<br>
		<p class="osa strong">Office of Students Affairs</p>
	</div>
    <h1> Scholars</h1>
    <a href="#" onclick="window.print()" class="no-print">Print</a>
    <?php if(sizeof($scholars)>0){?>
    <div class = "row">  
    	  	  	    
    	<table class="table table-striped table-hover table-responsive" id ="scholars-table">
    		<thead><tr class="table-header"><th></th><th>Name</th><th>Sex</th><th>Address</th><th>Scholarship</th></tr></thead>
    		<tbody>
    			<?php
    			$no=1;    			
				
    			foreach($scholars as $scholar){
    				if($this->session->userdata("admin_id")||$this->session->userdata("super_admin_id")||$scholar['info']->coll_id==$this->session->userdata("college_id")){
    			?>	    			
    			<tr>
    				<td><?php  echo $no++?></td>
    				<td><?php echo $scholar['info']->fname ?> <?php echo $scholar['info']->mname?> <?php echo $scholar['info']->lname ?></td>
    				<td><?php echo $scholar['info']->gender ?></td><td><?php echo $scholar['info']->brgy.", ".$scholar['info']->town .", ".$scholar['info']->prov ?></td>
    				<td><?php echo $scholar['info']->type ?></td>
    			</tr>
    			<?php
    				}
    			}
				?>
    		</tbody>
    	</table>
    	
    	<p class="left small">Printed: <?php echo date("m/d/Y")?></p>
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