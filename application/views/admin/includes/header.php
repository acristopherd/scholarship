
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="icon" type="image/png" href="<?php echo base_url();?>images/unp_icon.png">
    <title><?php echo $page_title ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url()?>css/admin.bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url()?>css/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url()?>css/sb-admin-2.css" rel="stylesheet">    
    <link href="<?php echo base_url()?>css/jquery.toastmessage.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url()?>font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<?php if(isset($style)) echo $style?>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
         <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">OSA Admin</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-right top-nav">
                <?php if($this->session->userdata('access_level')>=4){ ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="btn-msg-top">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu message-dropdown" id="msg-top">
                        
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="<?php echo site_url("message/inbox")?>">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <?php } ?>
                <!-- /.dropdown -->
                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?php echo $this->session->userdata('username') ?>&nbsp;<i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo site_url("user/account")?>"><i class="fa fa-user fa-fw"></i> Account</a>
                        </li>
                        
                        </li>
                        <li class="divider"></li>
                        	<li><a href="<?php echo site_url("admin/logout");?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            

            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                        
                        <li>
                            <a href="<?php echo site_url("admin")?>"><i class="fa fa-home fa-fw"></i> Home</a>
                        </li>
                        <li>
                        	
                            <a href="#" data-toggle="collapse" data-target="#scholarship-sub"><i class="fa fa-graduation-cap fa-fw"></i> Scholars<span class="fa arrow"></span></a>
                       		<ul id ="scholarship-sub" class="collapse">
                       			<li><a href="<?php echo site_url('scholar/view_signups')?>">Pending Signups</a></li>
		                        <li><a href="<?php echo site_url('scholar/view_scholar')?>?approved=0">Pending Scholarships</a></li>
		                        <li><a href="<?php echo site_url('scholar/view_scholar')?>?approved=1">Approved Scholarships</a></li>
		                    </ul>
                        </li>
                         <li>
                            
                        	 <a href="#" data-toggle="collapse" data-target="#announcement-sub"><i class="fa fa-bullhorn fa-fw"></i>Announcements<span class="fa arrow"></span></a>
                       		<ul id = "announcement-sub" class="collapse">
		                    	<li><?php if($this->session->userdata("access_level")>=4){?><a href="<?php echo site_url('announcement/')?>"> View</a><?php } ?></li>
		                        <li><?php if($this->session->userdata("access_level")>=4){?><a href="<?php echo site_url('announcement/view_archive')?>"> Archive</a><?php } ?></li>
		                    </ul>
                        </li>
                        <li>
                            <?php if($this->session->userdata("access_level")>=4){?><a href="<?php echo site_url('news/')?>"><i class="fa fa-th-list fa-fw"></i> News</a><?php } ?>
                        </li>
                        <?php if($this->session->userdata("access_level")>=4){?>
                        <li>
                        	<a href="#"data-toggle="collapse" data-target="#messages-sub"><i class="fa fa-envelope fa-fw"></i> Messages<span class="fa arrow"></span></a>
		                    <ul class="collapse" id = "messages-sub">
		                    	<li><a href="<?php echo site_url('message/admin_send')?>">Compose</a></li>
		                    	<li><a href="<?php echo site_url('message/inbox')?>">Inbox</a></li>
		                        <li><a href="<?php echo site_url('message/sent')?>">Sent</a></li>			                        	
		                    </ul>                            
                        </li>
                        <?php } ?>
                        <li>
                        	<?php if($this->session->userdata("access_level")>=4){?>
                             <a href="#" data-toggle="collapse" data-target="#utilities-sub"><i class="fa fa-gear fa-fw"></i> Utilities<span class="fa arrow"></span></a>
		                    <ul class="collapse" id = "utilities-sub">
		                    	<li><?php echo anchor("college","Colleges")?></li>
		                        <li><?php echo anchor("course","Courses")?></li>	
		                        <?php if($this->session->userdata("access_level")>4){?> <li><a href="<?php echo site_url('user')?>">Users</a></li>	<?php } ?>
		                        <li><a href="<?php echo site_url('scholarshiptype')?>">Scholarship Types</a></li>	
		                    </ul>
		                    <?php } ?> 
                        </li>
                        <li>
                            <?php if($this->session->userdata("access_level")>=4||$this->session->userdata("access_level")==2){?><a href="#"data-toggle="collapse" data-target="#report-sub"><i class="fa fa-book fa-fw"></i> Reports<span class="fa arrow"></span></a>
                            <ul class="collapse" id = "report-sub">
		                    	<li><?php echo anchor("scholar/choose_cat_to_print","Scholars")?></li>
		                    </ul>
                            <?php } ?>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            <!-- /.navbar-static-side -->
        </nav>
