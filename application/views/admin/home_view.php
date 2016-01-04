<?php 
$page_title = "Home - Admin";
include("includes/header.php");?>

<div id="page-wrapper">
	<div class = "container-fluid">
    <h1> Welcome <?php echo ucwords($this->session->userdata('fname'))?></h1>
    </div>
    <hr>
    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-home"></i> Home
        </li>
    </ol>
    <div classs="row">
    	<div class="col-lg-3 col-md-4">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-book fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $pending_scholarships?></div>
                            <div>Pending Scholarhips!</div>
                        </div>
                    </div>
                </div>
                <a href="<?php echo site_url("scholar/view_scholar/")?>?approved=0">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-4">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-envelope fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $new_messages?></div>
                            <div>Unread Messages!</div>
                        </div>
                    </div>
                </div>
                <a href="<?php echo site_url("message/inbox")?>">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-4">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-graduation-cap fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $pending_scholars?></div>
                            <div>New Scholars!</div>
                        </div>
                    </div>
                </div>
                <a href="<?php echo site_url("scholar/view_signups")?>">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
    	<div class = "col-lg-10 col-md-11">
				
				<div class="panel panel-success">
					<div class="panel-heading">
						<div class="h4">No. of Scholars per College</div>
					</div>
					<div class="panel-body">
						<div  id="scholarchart" style="width:100%;height:400px;display:block">Loading...</div>
					</div>
				</div>
				
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="h4">Scholars per Scholarship Type</div>
					</div>
					<div class="panel-body">
						<div  id="scholarpiechart" style="width:100%;height:400px;display:block">Loading...</div>
					</div>
				</div>
					
			</div>
    </div>
</div>
<!-- /#page-wrapper -->
<?php $script='
<!-- Flot Charts JavaScript -->
    <script src="'.base_url().'js/plugins/flot/excanvas.min.js"></script>
    <script src="'.base_url().'js/plugins/flot/jquery.flot.js"></script>
    <script src="'.base_url().'js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="'.base_url().'js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="'.base_url().'js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script type="text/javascript">
	
	$(document).ready(function(){
	
	$.get("'.site_url("scholar/get_latest_by_college").'?sid="+Math.random(),null,function(data){
		var no=1;
		chart_data=[];
		var ticks=[];
				$.each(data,function(key,value){
						
						//alert(no+" " + value.college);
						chart_data.push([no,value.sos]);
						ticks.push([no,value.college]);
						no++;
					});
				$("#scholarchart").html(ticks);
				var options = {
				    series: {
				        bars: {
				        	 show: true
						}
				    },
				     bars: {
		                align: "center",
		                barWidth: 0.8,
		                fillColor: { colors: [{ opacity: 0.5 }, { opacity: 1}] },
		                lineWidth: 1
		            },
				     xaxis: {
	                axisLabel: "Colleges",
	                axisLabelUseCanvas: true,
	                axisLabelFontSizePixels: 12,
	                axisLabelFontFamily: "Verdana, Arial",
	                axisLabelPadding: 10,
	                ticks: ticks,
	                color:"black"
	            	},
	            	yaxis: {
	                axisLabel: "No. of Scholars",
	                axisLabelUseCanvas: true,
	                axisLabelFontSizePixels: 12,
	                axisLabelFontFamily: "Verdana, Arial",
	                axisLabelPadding: 10,
	                color:"black"
	            	},
	            	grid: {
		                hoverable: true,
		                borderWidth: 1,
		                backgroundColor: { colors: ["#eee", "#ffffff"] }
		            }
				};
		 var dataset = [{data: chart_data, color: "rgb(124,240,19)" }];
		var plot =$.plot( $("#scholarchart"),dataset, options);
	},"json");
	
	
	$.get("'.site_url("scholar/get_latest_by_type").'?sid="+Math.random(),null,function(data){
		var no=0;
		chart_data=[];
		var colors=["#005CDE","#00A36A","#7D0096","#992B00","#DE000F","#ED7B00"];
				$.each(data,function(key,value){
						chart_data.push({label:value.type,data:value.sos,color:colors[no]});
						no++;
					});
				
				var options = {
				    series: {
				        pie: {
				        	 show: true,
				        	 label: {
			                    show:true,
			                    radius: 0.8,
			                    formatter: function (label, series) {
			                        	console.log(series);                
			                        return label + ": " + Math.round(series.percent,2)+"%";
									
			                    },
			                    background: {
			                        opacity: 0.8,
			                        color: "#EEE"
			                    }
			                    
		                	}
						}
				    },
				    grid:{hoverable:true}
				};
		
		var plot =$.plot( $("#scholarpiechart"),chart_data, options);
	},"json");
	
	
	});
</script>'
?>
<?php include("includes/footer.php");
