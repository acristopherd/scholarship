<?php include("includes/header.php");?>
    <!--header start-->

     <header id="myCarousel" class="carousel slide">
        <!-- Indicators 
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
		-->
        <!-- Wrapper for slides -->
        <div class="carousel-inner">            
            <div class="item next left">
                <div class="fill" style="background-image:url('<?php echo base_url(); ?>images/books.jpg');"></div>
                <div class="carousel-caption">
                    <h2>Scholarship</h2>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>
	<!--header ends-->
	
	<div class="modal">
		<?php echo $this->session->flashdata("message")?>
	</div>
	
	<section class = "container">
		<div class = "row">
			<p>&nbsp;</p>
		</div>
		<div class = "row">
			<div class = "col-lg-8">
				
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="h4">No. of Scholars per College</div>
					</div>
					<div class="panel-body">
						<div  id="scholarchart" style="width:100%;height:400px;display:block">Loading...</div>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="h4">Scholars per Scholarship Type</div>
					</div>
					<div class="panel-body">
						<div  id="scholarpiechart" style="width:100%;height:400px;display:block">Loading...</div>
					</div>
				</div>
					
			</div>
			<div class = "col-lg-4">
				<div class="panel panel-warning" id = "latest_announcement">
			        <div class="panel-heading">
			          <h4>Latest Announcement</h4>
			        </div>
			        <div class="panel-body">
			          <p>
			          	
			          </p>
			          
			        </div>
			        <div class="panel-footer">
			        	<a href = "<?php echo site_url("announcement/view")?>" class="btn btn-warning">Read More</a>
			        </div>
			    </div>
			    <div class="panel panel-success" id ="latest_news">
			        <div class="panel-heading">
			          <h4>Latest News</h4>
			        </div>
			        <div class="panel-body">
			          <p>
			          	
			          </p>
			          
			        </div>
			        <div class="panel-footer">
			        	<a href = "<?php echo site_url("news/view")?>" class="btn btn-success">Read More</a>
			        </div>
			    </div>
			</div>
			
		</div>
		<div class = "row">
			<p>&nbsp;</p>
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
	$.post("'.site_url("announcement/get_latest").'",{sid:Math.random()},function(data){
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
	$.post("'.site_url("news/get_latest").'",{sid:Math.random()},function(data){
				$.each(data,function(key,value){
					title=$("<p></p>").html(value.info.title).addClass("h4").addClass("text-center");
					hr = $("<hr />");
					img = $("<img>").attr("src","'.base_url().'news/thumbs/"+value.pics[0].loc);
					news=$("<p></p>").html(value.info.msg);
					if(value.info.msg.length>100)$(news).append($("<a></a>").html("...").attr("href","'.site_url("news/view").'#"+value.info.id))
					from = $("<i></i>").html("From: "+value.info.author).addClass("text-right");
					$("#latest_news .panel-body").append($(title)).append($(hr)).append($(img)).append($(news)).append($(hr).clone()).append($(from));
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

