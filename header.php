<?php include_once("inc/settings.php"); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,height=device-height,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,minimal-ui">
    <!-- android -->
    <meta name="mobile-web-app-capable" content="yes">
    <!-- iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <meta name="wsserver" content="<?= WS_SERVER ?>">
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
    <header class="header"></header>
    <section class="section" id="section">
      <aside class="side-left" id="aside" ondragstart="return false">
                <ul class="sidebar">
                    <!--li class="" id="dashboardtab">
                        <a href="dashboard.php" data-pjax=".content-body" onclick="activateTab('dashboardtab')">
                            <i class="sidebar-icon fa fa-home"></i>
                            <span class="sidebar-text">Dashboard</span>
                        </a>
                    </li--><!--/sidebar-item-->
                    <li id="processtab">
                        <a href="process.php" data-pjax=".content-body" onclick="activateTab('processtab')">
                            <i class="sidebar-icon fa fa-tasks"></i>
                            <span class="sidebar-text">Processes</span>
                        </a>
                    </li><!--/sidebar-item-->
                    <li id="servicestab">
                        <a href="services.php" data-pjax=".content-body" onclick="activateTab('servicestab')">
                            <i class="sidebar-icon fa fa-database"></i>
                            <span class="sidebar-text">Actions</span>
                        </a>
                    </li><!--/sidebar-item-->
                    <li id="maptab">
                        <a href="mapframe.php" data-pjax=".content-body" onclick="activateTab('maptab')">
                            <i class="sidebar-icon fa fa-map-marker"></i>
                            <span class="sidebar-text">Map</span>
                        </a>
                    </li><!--/sidebar-item-->
                    <li id="sensorstab">
                        <a href="sensors.php" data-pjax=".content-body" onclick="activateTab('sensorstab')">
                            <i class="sidebar-icon fa fa-wifi"></i>
                            <span class="sidebar-text">Sensors</span>
                        </a>
                    </li><!--/sidebar-item-->
                    <li id="systemtab">
                        <a href="system.php" data-pjax=".content-body" onclick="activateTab('systemtab')">
                            <i class="sidebar-icon fa fa-laptop"></i>
                            <span class="sidebar-text">System</span>
                        </a>
                    </li><!--/sidebar-item-->
                    <li id="diagnosticstab">
                        <a href="diagnostics.php" data-pjax=".content-body" onclick="activateTab('diagnosticstab')">
                            <div class="badge badge-danger hidden">lorem ipsum</div>
                            <i class="sidebar-icon fa fa-newspaper-o"></i>
                            <span class="sidebar-text">Diagnostics</span>
                        </a>
                    </li><!--/sidebar-item-->
                    <li id="logtab">
                        <a href="logs.php" data-pjax=".content-body" onclick="activateTab('logtab')">
                            <i class="sidebar-icon fa fa-table"></i>
                            <span class="sidebar-text">Logs</span>
                        </a>
                    </li><!--/sidebar-item-->
                    <li id="statetab">
                        <a href="state.php" data-pjax=".content-body" onclick="activateTab('statetab')">
                            <i class="sidebar-icon fa fa-share-alt"></i>
                            <span class="sidebar-text">State Machine</span>
                        </a>
                    </li><!--/sidebar-item-->
                    <li id="drivetab">
                        <a href="driveframe.php" data-pjax=".content-body" onclick="activateTab('drivetab')">
                            <i class="sidebar-icon fa fa-car"></i>
                            <span class="sidebar-text">Drive</span>
                        </a>
                    </li><!--/sidebar-item-->
               </ul>
     </aside>
     <div class="content">
       <div class="content-body">

