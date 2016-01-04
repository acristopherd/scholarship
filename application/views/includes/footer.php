 <?php if($this->session->flashdata("message")){ ?>
    <div class="modal fade hide" id="message">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="alert alert-message">	      	
	        <button type="button" class="close" data-dismiss="message" aria-label="Close" class="btn btn-primary" ><i class="fa fa-times-circle"></i></button>
	        <h4><?php echo $this->session->flashdata("message");?></h4>
	      </div>	     
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<?php } ?>
	</div><!--end of wrap-->
	<div class="footer">
       <div class="container">

            <p>&copy; <a href="#" rel="nofollow">Uiversity of Northern Phipippines Office of Student Affairs</a>. </p>
            <p>Email <a href="mailto:osa@unp.edu.ph">osa@unp.edu.ph</a>.</p>
            <p>Fax 722-0000</p>
            <p><a href="http://unp.edu.ph">University of Norhtern Philippines </a>|<a href = "http://www.vigancity.gov.ph/"> Vigan City</a></p>

          </div>
       
    </div>

	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url();?>js/jquery.js"></script>
    <script src="<?php echo base_url();?>js/jquery.validate.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>    
     <script src="<?php echo base_url();?>js/holder/holder.js"></script>
    <script src="<?php echo base_url();?>js/google-code-prettify/prettify.js"></script>
    <script src="<?php echo base_url();?>js/jquery.toastmessage.js"></script>
    <?php if(isset($script)) echo $script;?>
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
	
	
    </script>
    
  </body>
</html>