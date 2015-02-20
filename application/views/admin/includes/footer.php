 <?php if($this->session->flashdata("message")){ ?>
    <div class="modal fade in" id="message">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="alert alert-message">	      	
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close" class="btn btn-primary" ><i class="fa fa-times-circle"></i></button>
	        <h4><?php echo $this->session->flashdata("message");?></h4>
	      </div>	     
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<?php } ?>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url();?>js/jquery.js"></script>
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>js/plugins/metisMenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url();?>js/sb-admin-2.js"></script>    
    <script src="<?php echo base_url();?>js/jquery.toastmessage.js"></script>
    
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    });
    if (window.location.hash == "#message.html" && <?php echo $this->session->flashdata("message")?"true":"false";?>) {
			
	     $().toastmessage('showToast',{
		    text     : '<?php echo $this->session->flashdata("message");?>',
		    sticky   : false,
		    position : 'top-center',
		    type     : 'success',
		    inEffectDuration:  600,   // in effect duration in miliseconds
			stayTime:         3000
		});
		//alert('asfd');
		}
		if (window.location.hash == "#dialog.html") {
			$("#message").modal();
		}
	$(document).ready(function(){
		var loading=false;
		$("#btn-msg-top").bind("click",function(){
			loading=true;
			if(loading){
			$("#msg-top .msg-top-message").remove();
			$("#msg-top").prepend('<span class="loading">loading</span>');
			$.post("<?php echo site_url("message/view_some")?>",null,function(data){
				$("#msg-top span.loading").remove();
				$.each(data,function(key,value){
					//alert(value.subject);
					message={
						subject:$("<div></div>").append($("<strong></strong>").html(value.from_name)).append($("<span></span>").html(value.date_posted).addClass("pull-right text-muted")),
						msg:$("<div></div>").html(value.message+"...")
						};
					var anchor=$("<a></a>");
					$(anchor).append(message.subject).attr("href","message/view/"+value.id);
					 $(anchor).append(message.msg);
					$("#msg-top").prepend($("<li></li>").append($(anchor)).after($("<li></li>").addClass("divider")).addClass("msg-top-message"));
				});
				
			},"json");
			}
			loading=false;
		});
	});
    </script>
    
    <?php if(isset($script)) echo $script?>
    
  </body>
</html>