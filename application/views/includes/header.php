<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Scholarship Portal">
	<meta name="keywords" content="Scholarship,Scholar,UNP,University of Northern Philippines,Vigan">
	<meta name="author" content="Office of Student Affairs - University of Norther Philippines">
	<link rel="icon" type="image/png" href="<?php echo base_url();?>images/unp_icon.png">
    <title><?php echo (isset($title)?$title:"Main")?></title>
	
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>css/bootplus.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/bootplus-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/docs.css" rel="stylesheet">
    <link href="<?php echo base_url();?>js/google-code-prettify/prettify.css" rel="stylesheet">
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
  <div id="wrap">
  	<!--navigation top-->
  	<div class="container">
  	<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
        
          <a class="brand" href="<?php echo site_url('osa/')?>"><!--<img height="10" class="nav-bar-image" src="<?php echo base_url()?>images/close.gif"> -->UNP-OSA</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="" id ="nav-home"><a href="<?php echo site_url('osa/')?>">Home</a></li>
              <li class="dropdown" id ="nav-scholarship">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-graduation-cap fa-fw"></i> Scholarship <b class="caret"></b></a>
		          <ul class="dropdown-menu">
		            <li><?php if(!$this->session->userdata("user_id"))echo anchor("scholar/signup","Signup")?></li>
		            <li><?php echo anchor("scholar/apply","Apply")?></li>
		            <li class="dropdown-submenu" role ="menu">
		            	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Types</a>
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
		        <li id ="nav-announcement"><a href = "<?php echo site_url("announcement/view")?>"><i class="fa fa-bullhorn"></i> Announcements</a></li>
		        <?php
				}
				?>
		        <li id ="nav-news"><a href = "<?php echo site_url("news/view")?>"><i class="fa fa-th-list"></i> News</a></li>	     
		 		<li><?php if ($this->session->userdata("grantee_id")) echo anchor("osa/our_scholars","Our scholars")?></li>
	 			<!---<li><a href="#"><i class="fa fa-phone"></i> Contact</a></li>-->
	            <li id ="nav-about"><a href="<?php echo site_url("osa/about/")?>"><i class="fa fa-question"></i> About</a></li>
	            
            </ul>
            <ul class="nav  pull-right">
	      	 <!--
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
            </li>
           -->
            <?php if ($this->session->userdata("grantee_id")||$this->session->userdata("user_id")) {?>
           <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope fa-fw"></i> <b class="caret"></b></a>
	          <?php if ($this->session->userdata("grantee_id")) {?>
	          <ul class="dropdown-menu">
	          		<li><?php echo anchor("message/sponsor_send","Compose")?></li>
	          		<li><?php echo anchor("message/inbox","Inbox")?></li>
	          		<li><?php echo anchor("message/sent","Sent")?></li>
	          </ul>
	          <?php } ?>
	          <?php if ($this->session->userdata("user_id")) {?>
	          <ul class="dropdown-menu">
	          		<li><?php echo anchor("message/scholar_send","Compose")?></li>
	          		<li><?php echo anchor("message/inbox","Inbox")?></li>
	          		<li><?php echo anchor("message/sent","Sent")?></li>
	          </ul>
	          <?php } ?>
	        </li>
	        <?php } ?>
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
		            <li><a href="<?php echo site_url("scholar/edit_work/".$this->session->userdata("user_id"))?>">Work</a></li>
		            <li><a href="<?php echo site_url("scholar/edit_account/".$this->session->userdata("user_id"))?>">Account</a></li>
		            <li class="divider"></li>
		            <li><a href="<?php echo site_url("scholar/logout")?>"><i class="fa fa-sign-out fa-fw"></i>Logout</a></li>
		            
	            <?php
					}
					else if($this->session->userdata("grantee_id")){
				?>
					<li><a href="<?php echo site_url("osa/sponsor_logout")?>"><i class="fa fa-sign-out fa-fw"></i>Logout</a></li>
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
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
  	</div>
	  <!--end of navigation top-->

    