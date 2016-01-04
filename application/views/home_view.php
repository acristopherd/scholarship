
<?php $style = '
	<style type = "text/css">
		.announcements {
        background-image:url('.base_url().'images/books.jpg) !important	;
      }
      .separator-pics{
      	height:200px;
      	overflow:hidden;
      }
	  #myCarousel{min-height:250px !important;vertical-align:bottom !important;}
	  
	  .carousel-inner div:even(2){
	  	background:red !important;
	  }
	</style>
';?>
<?php include("includes/header.php");?>
    <!--header start-->
    
     
	<div class="container">
		<div class = "announcements">
			<div id="myCarousel" class="carousel slide">
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>
  <!-- Carousel items -->
  <div class="carousel-inner">
  </div>
  <!-- Carousel nav -->
  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div>
		</div>
		<div class = "row">
			<div class = "span8">
				
				<div class="card card-default">
					<div class="card-heading">
						<div class="h4">No. of Scholars per College</div>
					</div>
					<div class="card-body">
						<div  id="scholarchart" style="width:100%;height:400px;display:block">Loading...</div>
					</div>
				</div>
				
				<div class="card card-default">
					<div class="card-heading">
						<div class="h4">Scholars per Scholarship Type</div>
					</div>
					<div class="card-body">
						<div  id="scholarpiechart" style="width:100%;height:400px;display:block">Loading...</div>
					</div>
				</div>
					
			</div>
			<div class = "span4">
				
			    <div class="card card-success" id ="latest_news">
			        <div class="card-heading">
			          <h4>Latest News</h4>
			        </div>
			        <div class="card-body">
			          <p>
			          	
			          </p>
			          
			        </div>
			        <!--<div class="card-footer">
			        	<a href = "<?php echo site_url("news/view")?>" class="btn btn-success">Read More</a>
			        </div>-->
			    </div>
			</div>
			
		</div>
	</div>

	<?php $script='
<!-- Flot Charts JavaScript -->
    <script src="'.base_url().'js/plugins/flot/excanvas.min.js"></script>
    <script src="'.base_url().'js/plugins/flot/jquery.flot.js"></script>
    <script src="'.base_url().'js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="'.base_url().'js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="'.base_url().'js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script type="text/javascript">
	
	$(document).ready(function(){
		
	$("#myCarousel").carousel();
	//get announcement
	$.post("'.site_url("announcement/get_latest").'?qid="+Math.random(),{sid:Math.random()},function(data){
				var colors=["info","danger","success"];
				$.each(data,function(key,value){
					title=$("<p></p>").html(value.title).addClass("h4").addClass("text-center");
					hr = $("<hr />");
					announcement=$("<p></p>").html(value.msg);
					if(value.msg.length>100)$(announcement).append($("<a></a>").html("...").attr("href","'.site_url("announcement/view").'#"+value.id))
					from = $("<i></i>").html("From: "+value.from).addClass("text-right");
					$("#myCarousel .carousel-inner").append($("<div></div>").addClass("item").addClass("alert alert-"+colors[key]).append($(title)).append($(hr)).append($(announcement)).append($(hr).clone()).append($(from)));
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
					$("#latest_news .card-body").append($(title)).append($(hr));
					if(!(typeof value.pics[0] === "undefined")) $("#latest_news .card-body").append($(img))
					$("#latest_news .card-body").append($(news)).append($(hr).clone()).append($(from));
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
	$("#nav-home").addClass("active");
	
	});
</script>
';?>
<?php include("includes/footer.php");?>

