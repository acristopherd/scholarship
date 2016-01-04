
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login - Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url()?>css/admin.bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url()?>css/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url()?>css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url()?>font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
</head>

<body>

    <div id="wrapper">
    	<div class="modal fade in" id="login-form">
		  <div class="modal-dialog modal-sm">
		    <div class="modal-content">
	    	<?php echo form_open("admin/login_required",array("class"=>"form-horizontal"))?>
			
				<div class = "modal-header">
					<h3 class="h3">Login</h3>
					<h5>You must login to view this page.</h5>
				</div>
				<div class = "modal-body">
					<?php echo $this->session->flashdata("login_failed")?"<div class='alert alert-danger'>".$this->session->flashdata("login_failed")."</div>":"";?>
					<div class="form-input">
						<?php 
						echo form_label("Username:","username");
						echo form_input(array("class"=>"form-control input-sm","name"=>"username","placeholder"=>"Username","type"=>"text","required"=>"required"),set_value("username"));
						echo form_error("username");
						?>
					</div>
					<div class="form-input">
						<?php 
						echo form_label("Password:","password");
						echo form_input(array("class"=>"form-control input-sm","name"=>"password","placeholder"=>"Password","type"=>"password","required"=>"required"));
						echo form_error("password");
						?>
					</div>
				</div>
				<div class = "modal-footer">
					<?php echo form_submit(array("class"=>"btn btn-primary"),"Login")?>
					
				</div>
			
		<?php echo form_close()?>
    </div>
    
    <!-- for popup messages -->
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
    
    <script>
    if (window.location.hash == "#message.html") {
     $('#message').modal('show');
	}
	$('#login-form').modal({backdrop:'static'});
    </script>
    
    <?php if(isset($script)) echo $script?>
    
  </body>
</html>