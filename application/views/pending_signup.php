<?php include("includes/header.php");?>
  
	<section class = "container main-container">
		<div class = "row span6 col-md-6 col-sm-8">
			<div class="panel panel-danger">
				<div class="panel-heading">
					Account
				</div>
				<div class="panel-body">
					<p>Your account is not yet validated. We will validate your account withing 24 hours. Please be patient 'til then.</p>
				</div>
			</div>
			</div>
		
	</section>
	
	
	<?php $script='
<!-- Flot Charts JavaScript -->
    <script src="'.base_url().'js/plugins/flot/excanvas.min.js"></script>
    <script src="'.base_url().'js/plugins/flot/jquery.flot.js"></script>
    <script src="'.base_url().'js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="'.base_url().'js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="'.base_url().'js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script type="text/javascript">
	
	$(document).ready(function(){
	//get announcement
	$.post("'.site_url("announcement/get_latest").'?qid="+Math.random(),{sid:Math.random()},function(data){
				$.each(data,function(key,value){
					title=$("<p></p>").html(value.title).addClass("h4").addClass("text-center");
					hr = $("<hr />");
					announcement=$("<p></p>").html(value.msg);
					if(value.msg.length>100)$(announcement).append($("<a></a>").html("...").attr("href","'.site_url("announcement/view").'#"+value.id))
					from = $("<i></i>").html("From: "+value.from).addClass("text-right");
					$("#latest_announcement .panel-body").append($(title)).append($(hr)).append($(announcement)).append($(hr).clone()).append($(from));
				});
				
	},"json");
	
	//get news
	$.post("'.site_url("news/get_latest").'?qid="+Math.random(),{sid:Math.random()},function(data){
				$.each(data,function(key,value){
					title=$("<p></p>").html(value.info.title).addClass("h4").addClass("text-center");
					hr = $("<hr />");
					if(!(typeof value.pics[0] === "undefined")) img = $("<img>").attr("src","'.base_url().'news/thumbs/"+value.pics[0].loc);
					news=$("<p></p>").html(value.info.msg);
					if(value.info.msg.length>100)$(news).append($("<a></a>").html("...").attr("href","'.site_url("news/view").'#"+value.info.id))
					from = $("<i></i>").html("From: "+value.info.author).addClass("text-right");
					$("#latest_news .panel-body").append($(title)).append($(hr));
					if(!(typeof value.pics[0] === "undefined")) $("#latest_news .panel-body").append($(img))
					$("#latest_news .panel-body").append($(news)).append($(hr).clone()).append($(from));
				});
				
	},"json");
	
	
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
		                backgroundColor: { colors: ["#004C00", "#001C00"] }
		            }
				};
		 var dataset = [{data: chart_data, color: "gold" }];
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
</script>
';?>
<?php include("includes/footer.php");?>

