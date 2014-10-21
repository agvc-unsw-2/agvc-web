<?php include_once("inc/settings.php"); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title><?= WEBSITE_TITLE ?></title>

    <script src="js/jquery-2.1.1.min.js"></script>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link href="css/custom.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <section class="section">
      <aside class="side-left">
                <ul class="sidebar">
                    <li class="">
                        <a href="dashboard.php" data-pjax=".content-body">
                            <i class="sidebar-icon fa fa-home"></i>
                            <span class="sidebar-text">Dashboard</span>
                        </a>
                    </li><!--/sidebar-item-->
                    <li>
                        <a href="process.php" data-pjax=".content-body">
                            <i class="sidebar-icon fa fa-tasks"></i>
                            <span class="sidebar-text">Processes</span>
                        </a>
                    </li><!--/sidebar-item-->
                    <li>
                        <a href="mapframe.php" data-pjax=".content-body">
                            <div class="badge badge-primary animated animated-repeat wobble">3</div>
                            <i class="sidebar-icon fa fa-map-marker"></i>
                            <span class="sidebar-text">Map</span>
                        </a>
                    </li><!--/sidebar-item-->
                    <li>
                        <a href="sensors.php" data-pjax=".content-body">
                            <i class="sidebar-icon fa fa-wifi"></i>
                            <span class="sidebar-text">Sensors</span>
                        </a>
                    </li><!--/sidebar-item-->
                    <li>
                        <a href="system.php" data-pjax=".content-body">
                            <i class="sidebar-icon fa fa-laptop"></i>
                            <span class="sidebar-text">System</span>
                        </a>
                    </li><!--/sidebar-item-->
                    <li>
                        <a href="network.php" data-pjax=".content-body">
                            <i class="sidebar-icon fa fa-link"></i>
                            <span class="sidebar-text">Network</span>
                        </a>
                    </li><!--/sidebar-item-->
                    <li>
                        <a href="logs.php" data-pjax=".content-body">
                            <i class="sidebar-icon fa fa-table"></i>
                            <span class="sidebar-text">Logs</span>
                        </a>
                    </li><!--/sidebar-item-->
                    <li>
                        <a href="driveframe.php" data-pjax=".content-body">
                            <i class="sidebar-icon fa fa-car"></i>
                            <span class="sidebar-text">Drive</span>
                        </a>
                    </li><!--/sidebar-item-->
               </ul>
     </aside>
     <div class="content">
       <div class="content-body">

