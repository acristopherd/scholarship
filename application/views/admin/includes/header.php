
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

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
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
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

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="btn-msg-top">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages" id="msg-top">
                        
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="<?php echo site_url("message")?>">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
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
            

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control input-sm" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default btn-sm" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="<?php echo site_url("admin")?>"><i class="fa fa-home fa-fw"></i> Home</a>
                        </li>
                        <li>
                        	
                            <a href="#"><i class="fa fa-graduation-cap fa-fw"></i> Scholars<span class="fa arrow"></span></a>
                       		<ul class="nav nav-second-level collapse">
		                    	<li><a href="<?php echo site_url('scholar/view_scholar')?>?approved=0">Pending</a></li>
		                        <li><a href="<?php echo site_url('scholar/view_scholar')?>?approved=1">Approved</a></li>
		                    </ul>
                        </li>
                         <li>
                            <?php if($this->session->userdata("access_level")>=4){?><a href="<?php echo site_url('announcement/')?>"><i class="fa fa-bullhorn fa-fw"></i> Announcements</a><?php } ?>
                        </li>
                        <li>
                            <?php if($this->session->userdata("access_level")>=4){?><a href="<?php echo site_url('news/')?>"><i class="fa fa-th-list fa-fw"></i> News</a><?php } ?>
                        </li>
                        <?php if($this->session->userdata("access_level")>=4){?>
                        <li>
                        	<a href="#"><i class="fa fa-envelope fa-fw"></i> Messages<span class="fa arrow"></span></a>
		                    <ul class="nav nav-second-level collapse">
		                    	<li><a href="<?php echo site_url('message/admin_send')?>">Compose</a></li>
		                    	<li><a href="<?php echo site_url('message/inbox')?>">Inbox</a></li>
		                        <li><a href="<?php echo site_url('message/sent')?>">Sent</a></li>			                        	
		                    </ul>                            
                        </li>
                        <?php } ?>
                        <li>
                        	<?php if($this->session->userdata("access_level")>=4){?>
                             <a href="#"><i class="fa fa-gear fa-fw"></i> Utilities<span class="fa arrow"></span></a>
		                    <ul class="nav nav-second-level collapse">
		                    	<li><?php echo anchor("college","Colleges")?></li>
		                        <li><?php echo anchor("course","Courses")?></li>	
		                        <li><a href="<?php echo site_url('user')?>">Users</a></li>	
		                        <li><a href="<?php echo site_url('scholarshiptype')?>">Scholarship Types</a></li>	
		                    </ul>
		                    <?php } ?> 
                        </li>
                        <li>
                            <?php if($this->session->userdata("access_level")>=4||$this->session->userdata("access_level")==2){?><a href="#"><i class="fa fa-book fa-fw"></i> Reports<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
		                    	<li><?php echo anchor("scholar/choose_cat_to_print","Scholars")?></li>
		                    </ul>
                            <?php } ?>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
