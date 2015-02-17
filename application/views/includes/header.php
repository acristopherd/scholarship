<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo (isset($title)?$title:"Main")?></title>
	
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/modern-business.css" rel="stylesheet">
    <link href="<?php echo base_url()?>font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url()?>css/jquery.toastmessage.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/all.css" rel="stylesheet">
	<?php echo (isset($link)?$link:" ")?>
	<?php echo (isset($style)?$style:" ")?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php if(isset($headscript)) echo $headscript;?>
  </head>
  <body>
  	<!--navigation top-->
  	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      
	      <a class="navbar-brand" href="<?php echo site_url("osa")?>"><span>UNP - OSA</span></a>
	    </div>
	    <div class="navbar-collapse collapse navbar-responsive-collapse">
	      <ul class="nav navbar-nav">
	        <li><a href="<?php echo site_url("osa")?>"><i class="fa fa-home fa-fw"></i> Home</a></li>
	        
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-graduation-cap fa-fw"></i> Scholarship <b class="caret"></b></a>
	          <ul class="dropdown-menu">
	            <li><?php if(!$this->session->userdata("user_id"))echo anchor("scholar/signup","Signup")?></li>
	            <li><?php echo anchor("scholar/apply","Apply")?></li>
	            <li class="dropdown"><a href="#">Types</a>
	            	<ul class = "dropdown-menu">
	            		<li><a href = "#">Barangay Scholar</a></li>
	            		<li><a href = "#">CHED Scholar</a></li>
	            		<li><a href = "#">City Scholar</a></li>
	            		<li><a href = "#">course Scholar</a></li>
	            	</ul>
	            </li>
	            
	          </ul>
	        </li>
	        <?php if($this->session->userdata("user_id")||$this->session->userdata("grantee_id")){?>
	        <li><a href = "<?php echo site_url("announcement/view")?>"><i class="fa fa-bullhorn"></i> Announcements</a></li>
	        <?php
			}
			?>
	        <li><a href = "<?php echo site_url("news/view")?>"><i class="fa fa-th-list"></i> News</a></li>	        
	 		<li><a href = "#">OSA</a></li>
	 		<li><?php if ($this->session->userdata("grantee_id")) echo anchor("osa/our_scholars","Our scholars")?></li>
	 		<li><?php if ($this->session->userdata("grantee_id")) echo anchor("message/add","Send Message")?></li>
	      </ul>
	     
	      <ul class="nav navbar-nav navbar-right">
	      	 
	        <li>
	        	<form class="navbar-form">
                <div class="input-group">
                    <input type="text" class="form-control input-sm" placeholder="Search...">
                    <span class="input-group-btn">
                    <button class="btn btn-default btn-sm" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                	</span>
                </div>
                </form>
                <!-- /input-group -->
            </li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user fa-fw"></i> <b class="caret"></b></a>
	          <ul class="dropdown-menu">   
	          	<?php
	          	if($this->session->userdata("user_id")||$this->session->userdata("grantee_id")){
	          		if($this->session->userdata("user_id")){
	          	?>                     
		            <li><a href="<?php echo site_url("scholar/my_scholarship") ?>">My Scholarship</a></li>
		            <li class="divider"></li>
		            <li><a href="<?php echo site_url("scholar/edit_personal/".$this->session->userdata("user_id"))?>">Personal Info</a></li>
		            <li><a href="<?php echo site_url("scholar/edit_family/".$this->session->userdata("user_id"))?>">Family Background</a></li>
		            <li><a href="<?php echo site_url("scholar/edit_educ/".$this->session->userdata("user_id"))?>">Education</a></li>
		            <li><a href="<?php echo site_url("scholar/edit_account/".$this->session->userdata("user_id"))?>">Account</a></li>
		            <li class="divider"></li>
		            <li><a href="<?php echo site_url("scholar/logout")?>"><i class="fa fa-sign-out fa-fw"></i>Logout</a></li>
		            
	            <?php
					}
					else if($this->session->userdata("grantee_id")){
				?>
					<li><a href="<?php echo site_url("osa/grantee_logout")?>"><i class="fa fa-sign-out fa-fw"></i>Logout</a></li>
				<?php
					}
				}
				else{
				?>
				<li><a href="<?php echo site_url("scholar/login")?>"><i class="fa fa-sign-in fa-fw"></i>Login</a></li>
				<?php
				}
				?>
	          </ul>
	        </li>
	        <li class="divider ">&nbsp;</li>
	      </ul>
	    </div>
	  </nav>
	  <!--end of navigation top-->
    